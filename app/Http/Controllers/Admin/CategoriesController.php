<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EmployersCategory;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return DataTables::of(EmployersCategory::latest()->get())
                ->addIndexColumn()
                ->addColumn('action', 'Admin.Pages.categories.action')
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('Admin.Pages.categories.list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin.Pages.categories.addEdit', [
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
            'title' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $category = new EmployersCategory;
        $category->title = $request->title;
        $category->a4a_sort = $request->a4a_sort;
        $category->save();

        return redirect()->route('categories.index')->with('success', 'EmployersCategory has been created successfully.');
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
        $category = EmployersCategory::find($id);

        if (!$category) return redirect()->back()->with('error', 'Invalid request. Please try again');

        return view('Admin.Pages.categories.addEdit', [
            'action' => 'EDIT',
            'category' => $category,
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
            'title' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $category = EmployersCategory::find($id);
        $category->title = $request->title;
        $category->a4a_sort = $request->a4a_sort;
        $category->save();

        return redirect()->route('categories.index')->with('success', 'EmployersCategory has been updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = EmployersCategory::find($id);

        if (!$category) return redirect()->back()->with('error', 'Invalid request. Please try again');

        $category->delete();

        return response()->json([
            'status' => 'SUCCESS',
            'message' => 'EmployersCategory has been deleted successfully'
        ]);
    }
}
