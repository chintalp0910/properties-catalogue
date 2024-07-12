<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Agent;
use App\Models\Properties;
use App\Models\Gallery;
use Validator;
use Illuminate\Support\Facades\Redirect; 

class PropertiesController extends Controller
{
  public function properties_list (){
   return view('Admin/Pages/properties_list')->with(['title' =>"Paramount Properties List" ]);  
 }

 public function property_edit(){
  return view('Admin/Pages/properties_edit')->with(['title' => "Property Edit"]);  
}

public function property_add (){    
 return view('Admin/Pages/properties_add')->with(['title' =>"Property Add"]);  
}

public function property_view(){
  return view('Admin/Pages/properties_view')->with(['title' =>"Property View"]);
}
public function property_delete($id){
  /*Properties::where('id', $id)->delete();*/
  return response()->json(['success' => 'Record has been deleted successfully!']);
}

public function add_category(){
  /*$listproperties= Category::all();*/  
  return view('Admin/Pages/category_list')->with(['title' =>"Paramount Category List"]);
} 
public function dashboard(){
  return view('Admin/Pages/dashboard')->with(['title' =>  "Paramount Dashboard"]);
}


}
