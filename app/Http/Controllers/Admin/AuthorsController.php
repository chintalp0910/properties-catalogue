<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\ModelsExtended\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class AuthorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return DataTables::of(Author::latest()->get())
                ->editColumn('short_description', function ($row) {
                    return substr($row->short_description, 0, 150);
                })
                ->addIndexColumn()
                ->addColumn('action', 'Admin.Pages.authors.action')
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('Admin.Pages.authors.list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin.Pages.authors.addEdit', [
            'action' => 'ADD',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $author = new Author;
        $author->name = $request->name;
        $author->short_description = $request->short_description;
        if ($request->has('image_relative_url')) {
            $image_relative_url = $request->file('image_relative_url');
            $fileName = $image_relative_url->hashName();
            $image_relative_url->move(public_path('uploads/authors'), $fileName);
            $author->image_relative_url = $fileName;
        }
        $author->save();

        return redirect()->route('authors.index')->with('success', 'Author has been created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $author = Author::find($id);

        if (!$author) return redirect()->back()->with('error', 'Invalid request. Please try again');

        return view('Admin.Pages.authors.addEdit', [
            'action' => 'EDIT',
            'author' => $author,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $author = Author::find($id);
        $author->name = $request->name;
        $author->short_description = $request->short_description;
        if ($request->has('image_relative_url')) {
            if (File::exists(public_path('uploads/authors/' . $author->image_relative_url . ''))) {
                File::delete(public_path('uploads/authors/' . $author->image_relative_url . ''));
            }
            $image_relative_url = $request->file('image_relative_url');
            $fileName = $image_relative_url->hashName();
            $image_relative_url->move(public_path('uploads/authors'), $fileName);
            $author->image_relative_url = $fileName;
        }
        $author->save();

        return redirect()->route('authors.index')->with('success', 'Author has been updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $author = Author::find($id);

        if (!$author) return redirect()->back()->with('error', 'Invalid request. Please try again');

        $author->delete();

        return response()->json([
            'status' => 'SUCCESS',
            'message' => 'Author has been deleted successfully'
        ]);
    }
}
