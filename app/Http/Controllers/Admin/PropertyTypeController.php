<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PropertyType;
use App\ModelsExtended\Property;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class PropertyTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return DataTables::of(PropertyType::get())
                ->addIndexColumn()
                ->addColumn('action', 'Admin.Pages.property_type.action')
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('Admin.Pages.property_type.list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin.Pages.property_type.addEdit', [
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
            'description' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $type = new PropertyType;
        $type->description = $request->description;
        $type->save();

        return redirect()->route('property-type.index')->with('success', 'Property type has been created successfully.');
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
        $type = PropertyType::find($id);

        if (!$type) return redirect()->back()->with('error', 'Invalid request. Please try again');

        return view('Admin.Pages.property_type.addEdit', [
            'action' => 'EDIT',
            'type' => $type,
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
            'description' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $type = PropertyType::find($id);
        $type->description = $request->description;
        $type->save();

        return redirect()->route('property-type.index')->with('success', 'Property type has been updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $type = PropertyType::find($id);

        if (!$type) return redirect()->back()->with('error', 'Invalid request. Please try again');

        $Properties_assign_count = Property::where('property_type_id', $id)->count();
        $status = '';
        $message = "";
        if(empty($Properties_assign_count)){
            $type->delete();
            $status = 'SUCCESS';
            $message = "Property type has been deleted successfully";  
        }else{
            $status = 'FAILURE';
            $message = "Property type assigned with one or more properties, you can't delete"; 
        }
        

        return response()->json([
            'status' => $status,
            'message' => $message
        ]);
    }
}
