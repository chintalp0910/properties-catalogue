<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\ModelsExtended\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class AdministratorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return DataTables::of(User::latest()->get())
                ->addIndexColumn()
                ->addColumn('action', 'Admin.Pages.administrator.action')
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('Admin.Pages.administrator.list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::query()->whereIn("id", [\App\ModelsExtended\Role::Admin])->get();

        return view('Admin.Pages.administrator.addEdit', [
            'action' => 'ADD',
            'roles' => $roles,
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
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $administrator = new User;
        $administrator->name = $request->name;
        $administrator->email = $request->email;
        $administrator->password = Hash::make($request->password);
        $administrator->role_id = 2;
        $administrator->organization_id = $request->organization_id;
        $administrator->phone = $request->phone;

        if ($request->has('image_relative_url')) {
            $image_relative_url = $request->file('image_relative_url');
            $fileName = $image_relative_url->hashName();
            $image_relative_url->move(public_path('administrator_image'), $fileName);
            $administrator->image_relative_url = $fileName;
        }
        $administrator->save();

        return redirect()->route('administrator.index')->with('success', 'Administrator has been created successfully.');
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
        $administrator = User::find($id);
        $roles = Role::get();

        if (!$administrator) return redirect()->back()->with('error', 'Invalid request. Please try again');

        return view('Admin.Pages.administrator.addEdit', [
            'action' => 'EDIT',
            'administrator' => $administrator,
            'roles' => $roles,
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
            'email' => 'required|email|unique:users,email,' . $id,
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $administrator = User::getById($id);
        $administrator->name = $request->name;
        $administrator->email = $request->email;
        if (!empty($request->password)) $administrator->password = Hash::make($request->password);
        $administrator->role_id = 2;
        $administrator->organization_id = $request->organization_id;
        $administrator->phone = $request->phone;

        if ($request->has('image_relative_url')) {
            $image_relative_url = $request->file('image_relative_url');
            $fileName = $image_relative_url->hashName();
            $image_relative_url->move(public_path('administrator_image'), $fileName);
            $administrator->image_relative_url = $fileName;
        }
        $administrator->save();

        return redirect()->route('administrator.index')->with('success', 'Administrator has been updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $administrator = User::getById($id);

        if (!$administrator) return redirect()->back()->with('error', 'Invalid request. Please try again');
        if ($administrator->id === auth()->id()) return redirect()->back()->with('error', 'You can not delete yourself!');
        if ($administrator->role_id === \App\ModelsExtended\Role::SuperAdmin)
            return redirect()->back()->with('error', 'You can not delete super admins.');

        $administrator->delete();

        return response()->json([
            'status' => 'SUCCESS',
            'message' => 'Administrator has been deleted successfully'
        ]);
    }

    public function changePassword(Request $request)
    {
        if ($request->isMethod('POST')) {
            $validator = Validator::make($request->all(), [
                'password' => 'required',
                'confirm_password' => 'required|same:password'
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            User::find(auth()->user()->id)->update(['password' => Hash::make($request->password)]);

            return redirect()->route('dashboard')->with('success', 'Password has been updated successfully.');
        }

        return view('Admin.Pages.administrator.change_password');
    }
}
