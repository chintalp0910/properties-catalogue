<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{

  public function login(){
    return view('Admin/Pages/login')->with(['title' =>"Paramount Admin login"]);
  }
  
  public function adminlogin(Request $request){
   return redirect('admin/dashbord');
  }

  public function logout(Request $request ) {
   return view('Admin/Pages/login')->with(['title' =>"Paramount Admin login"]);
  }

}
