<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Employer;
use App\Models\EmployersCategory;
use App\Models\OfficeType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class EmployersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Employer::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', 'Admin.Pages.employers.action')
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('Admin.Pages.employers.list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = EmployersCategory::all();
        $officeType = OfficeType::all();
        return view('Admin.Pages.employers.addEdit', [
            'action' => 'ADD',
            'categories' => $categories,
            'officeType' => $officeType,
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
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:employers,email',
            'phone' => 'required',
            'category' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $employer = new Employer;
        $employer->first_name = $request->first_name;
        $employer->last_name = $request->last_name;
        $employer->email = $request->email;
        $employer->phone = $request->phone;
        $employer->fax = $request->fax;
        $employer->category = $request->category;
        $employer->a4a_sort = $request->a4a_sort;
        $employer->position = $request->position;
        $employer->break_display_after = $request->break_display_after;
        $employer->office_type_id = $request->office_type_id;
        

        if ($request->has('image_relative_url')) {
            $image_relative_url = $request->file('image_relative_url');
            $fileName = $image_relative_url->hashName();
            $image_relative_url->move(public_path('employer_image'), $fileName);
            $employer->image_relative_url = $fileName;
        }
        $employer->save();

        return redirect()->route('employers.index')->with('success', 'Employer has been created successfully.');
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
        $employer = Employer::find($id);
        $officeType = OfficeType::all();
        $categories = EmployersCategory::all();

        if (!$employer) return redirect()->back()->with('error', 'Invalid request. Please try again');

        return view('Admin.Pages.employers.addEdit', [
            'action' => 'EDIT',
            'employer' => $employer,
            'categories' => $categories,
            'officeType' => $officeType,
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
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:employers,email,' . $id,
            'phone' => 'required',
            'category' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $employer = Employer::find($id);
        $employer->first_name = $request->first_name;
        $employer->last_name = $request->last_name;
        $employer->email = $request->email;
        $employer->phone = $request->phone;
        $employer->fax = $request->fax;
        $employer->category = $request->category;
        $employer->a4a_sort = $request->a4a_sort;
        $employer->position = $request->position;
        $employer->break_display_after = $request->break_display_after;
        $employer->office_type_id = $request->office_type_id;

        if ($request->has('image_relative_url')) {
            if (File::exists(public_path('employer_image/' . $employer->image_relative_url . ''))) {
                File::delete(public_path('employer_image/' . $employer->image_relative_url . ''));
            }
            $image_relative_url = $request->file('image_relative_url');
            $fileName = $image_relative_url->hashName();
            $image_relative_url->move(public_path('employer_image'), $fileName);
            $employer->image_relative_url = $fileName;
        }
        $employer->save();

        return redirect()->route('employers.index')->with('success', 'Employer has been updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employer = Employer::find($id);

        if (!$employer) return redirect()->back()->with('error', 'Invalid request. Please try again');

        $employer->delete();

        return response()->json([
            'status' => 'SUCCESS',
            'message' => 'Employer has been deleted successfully'
        ]);
    }
}
