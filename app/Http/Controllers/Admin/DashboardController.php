<?php

namespace App\Http\Controllers\Admin;

class DashboardController extends \App\Http\Controllers\Controller
{

    public function index()
    {
        return redirect('/admin/agents');
//        return view('Admin.Pages.dashboard')->with(['title' =>  "Paramount Dashboard"]);
    }

}