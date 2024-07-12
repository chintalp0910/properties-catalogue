<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\ModelsExtended\Agent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class AgentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Agent::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', 'Admin.Pages.agent.action')
                ->addColumn('checkbox', function ($row) {
                    $html = '<div class="custom-control custom-checkbox text-center">
                                <input type="checkbox" class="custom-control-input checkItem"
                                    name="agentID[]" id="checkbox' . $row->id . '" value="' . $row->id . '">
                                <label class="custom-control-label" for="checkbox' . $row->id . '"></label>
                            </div>';
                    return $html;
                })
                ->rawColumns(['action', 'checkbox'])
                ->make(true);
        }

        return view('Admin.Pages.agent.list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin.Pages.agent.addEdit', [
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
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:agent,email',
            'phone' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $agent = new Agent;
        $agent->first_name = $request->first_name;
        $agent->last_name = $request->last_name;
        $agent->name = $request->first_name . ' ' . $request->last_name;
        $agent->email = $request->email;
        $agent->phone = $request->phone;
        $agent->fax = $request->fax;
        $agent->category = $request->category;
        $agent->a4a_sort = $request->a4a_sort;
        $agent->created_by_id = Auth::user()->id;
        $agent->save();

        // update image if uploaded
        if ($request->hasFile('image_uploaded')) {
            $agent->image_relative_url = $agent->saveImageOnCloud($request->file('image_uploaded'));
            $agent->update();
        }


        return redirect()->route('agents.index')->with('success', 'Agent has been created successfully.');
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
        $agent = Agent::find($id);

        if (!$agent) return redirect()->back()->with('error', 'Invalid request. Please try again');

        return view('Admin.Pages.agent.addEdit', [
            'action' => 'EDIT',
            'agent' => $agent,
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
            'email' => 'required|email|unique:agent,email,' . $id,
            'phone' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $agent = Agent::find($id);
        $agent->first_name = $request->first_name;
        $agent->last_name = $request->last_name;
        $agent->name = $request->first_name . ' ' . $request->last_name;
        $agent->email = $request->email;
        $agent->phone = $request->phone;
        $agent->fax = $request->fax;
        $agent->category = $request->category;
        $agent->a4a_sort = $request->a4a_sort;
        $agent->created_by_id = Auth::user()->id;
        $agent->save();

        // update image if uploaded
        if ($request->hasFile('image_uploaded')) {
            if (File::exists(public_path('uploads/' . $agent->image_relative_url . ''))) {
                File::delete(public_path('uploads/' . $agent->image_relative_url . ''));
            }
            $agent->image_relative_url = $agent->saveImageOnCloud($request->file('image_uploaded'));
            $agent->update();
        }

        return redirect()->route('agents.index')->with('success', 'Agent has been updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $agent = Agent::find($id);

        if (!$agent) return redirect()->back()->with('error', 'Invalid request. Please try again');

        $agent->delete();

        return response()->json([
            'status' => 'SUCCESS',
            'message' => 'Agent has been deleted successfully'
        ]);
    }

    public function bulkDelete(Request $request)
    {
        if (empty($request->agentID)) return redirect()->back()->with('error', 'Please select a record/s to delete.');

        Agent::whereIn('id', $request->agentID)->delete();

        return response()->json([
            'status' => 'SUCCESS',
            'message' => 'Agents has been updated successfully.'
        ]);
    }
}
