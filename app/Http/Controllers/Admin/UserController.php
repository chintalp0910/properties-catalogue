<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Validator;

//redict



class UserController extends Controller
{

  public function login()
  {
    return view('Admin.Pages.login')->with(['title' => "Paramount Admin login"]);
  }

  public function adminlogin()
  {
    return redirect('admin/dashboard');
  }

  public function logout(Request $request)
  {
    return view('Admin.Pages.login')->with(['title' => "Paramount Admin login"]);
  }
}
