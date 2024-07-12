<?php

namespace App\Http\Controllers\Admin;

use App\Console\Commands\Fixes\GenerateShortStateNames;
use App\Http\Controllers\Controller;
use App\Models\Agent;
use App\Models\DemographicCategory;
use App\Models\DemographicMile;
use App\Models\PropertyDemographic;
use App\Models\PropertyType;
use App\ModelsExtended\Property;
use App\Models\PropertyAgent;
use App\Models\PropertyPicture;
use App\Models\PropertyStatus;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class PropertiesController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
   */
  public function index(Request $request)
  {
    $types = PropertyType::get();

    if ($request->ajax()) {
      // if (!empty($request->property_type)) {
      //   $query->where('property_type_id', $request->property_type);
      // }

      $query = Property::select('property.*', 'property_type.description as property_type')
        ->leftJoin('property_type', 'property_type.id', '=', 'property.property_type_id');

      return DataTables::of($query)
        ->addIndexColumn()
        ->addColumn('action', 'Admin.Pages.properties.action')
        // ->addColumn('type', function ( Property $row){
        //     return $row->property_type->description;
        // })
        ->addColumn('checkbox', function ($row) {
          $html = '<div class="custom-control custom-checkbox text-center">
                      <input type="checkbox" class="custom-control-input checkItem"
                          name="propertiesID[]" id="checkbox' . $row->id . '" value="' . $row->id . '">
                      <label class="custom-control-label" for="checkbox' . $row->id . '"></label>
                  </div>';
          return $html;
        })
        ->rawColumns(['action', 'checkbox'])
        ->make(true);
    }

    return view('Admin.Pages.properties.list', compact('types'));
  }


  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    $categories = DemographicCategory::orderBy('id', 'ASC')->get();
    $demographicMiles = DemographicMile::get();
    $agents = Agent::get();
    $status = PropertyStatus::get();
    $types = PropertyType::get();

    return view('Admin.Pages.properties.add')->with([
      'title' => "Property Add",
      'categories' => $categories,
      'demographicMiles' => $demographicMiles,
      'agents' => $agents,
      'types' => $types,
      'status' => $status
    ]);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'name' => 'required',
      'state' => 'required',
      'city' => 'required',
      'square_foot' => 'required',
      'agent_id' => 'required',
      'image_relative_url' => 'image',
    ]);

    if ($validator->fails()) {
      return redirect()->back()->withErrors($validator)->withInput();
    }
    $existFile = [];

    $property = new Property;
    $property->name = $request->name;
    $property->state = $request->state;
    $property->city = $request->city;
    $property->square_foot = $request->square_foot;
    $property->property_type_id = $request->property_type_id;
    $property->property_status_id = $request->property_status_id;
    $property->address = $request->address;
    $property->longitude = $request->longitude;
    $property->latitude = $request->latitude;
    $property->description = $request->description;
    $property->gla = $request->gla;
    // $property->anchor_tenant = $request->anchor_tenant;
    $property->featured = $request->featured;
    $property->created_by_id = Auth::user()->id;
    $property->show_in_map = $request->show_in_map == 1 ? 1 : 0;
    $property->orderby_featured = $request->orderby_featured;


    if ($request->has('anchor_tenant')) {
      foreach ($request->file('anchor_tenant') as $file) {
        if (File::exists(public_path('uploads/properties/anchor_tenant' . $file . ''))) {
          File::delete(public_path('uploads/properties/anchor_tenant' . $file . ''));
        }
        $image_relative_url = $file;
        $fileName = $image_relative_url->hashName();
        $image_relative_url->move(public_path('uploads/properties/anchor_tenant'), $fileName);
        array_push($existFile, $fileName);
      }
      $property->anchor_tenant = json_encode($existFile);
    }

    if ($request->has('brochure_relative_url')) {
      $brochure_relative_url = $request->file('brochure_relative_url');
      // $fileName = $brochure_relative_url->hashName();
      $fileName = $request->brochure_relative_url->getClientOriginalName();
      $fileName = str_replace(' ', '-', $fileName);
      $brochure_relative_url->move(public_path('brochure_relative'), $fileName);
      $property->brochure_relative_url = $fileName;
    }

    if ($request->has('site_plan_relative_url')) {
      $site_plan_relative_url = $request->file('site_plan_relative_url');
      // $fileName = $site_plan_relative_url->hashName();
      $fileName = $request->site_plan_relative_url->getClientOriginalName();
      $fileName = str_replace(' ', '-', $fileName);
      $site_plan_relative_url->move(public_path('site_plan'), $fileName);
      $property->site_plan_relative_url = $fileName;
    }

    if ($request->has('image_relative_url')) {
      $image_relative_url = $request->file('image_relative_url');
      $fileName = $image_relative_url->hashName();
      $image_relative_url->move(public_path('property_image'), $fileName);
      $property->image_relative_url = $fileName;
    }

    $property->save();

    // launch state update in background
    dispatch(function () use ($property){ GenerateShortStateNames::updatePropertyShortState( $property ); });

    foreach ($request->agent_id as $key => $agentID) {
      $property->agents()->create(["agent_id" => $agentID]);
    }

    foreach ($request->demographic_mile as $key => $mileIDs) {
      foreach ($mileIDs as $key1 => $value) {
        $property->property_demographics()->create([
          "demographic_category_id" => $key,
          "demographic_mile_id" => $key1,
          "value" => $value,
        ]);
      }
    }

    if ($request->has('file')) {
      foreach ($request->file('file') as $key => $file) {

        $image_relative_url = $file;
        $fileName = $image_relative_url->hashName();
        $image_relative_url->move(public_path('gallery'), $fileName);

        $property->property_pictures()->create([
          'image_relative_url' => $fileName,
          'image_order' => $request->image_order[$key],
        ]);
      }
    }

    return redirect()->route('properties.edit', $property->id)->with('success', 'Property has been created successfully.');
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
    $property = Property::with(['property_pictures'])->find($id);
    $status = PropertyStatus::get();

    if (!$property) return redirect()->back()->with('error', 'Invalid request. Please try again');

    $categories = DemographicCategory::orderBy('id', 'ASC')->get();
    $agents = Agent::get();
    $types = PropertyType::get();
    $myArray = [];
    foreach ($categories as $category) {
      $PropertyDemographic = PropertyDemographic::where('property_id', $id)->where('demographic_category_id', $category->id)->get();
      $myArray[$category->id] = $PropertyDemographic;
    }

    $property->anchor_tenant = json_decode($property->anchor_tenant);

    ksort($myArray);
    $PropertyDemographic = $myArray;
    $selectAgent = PropertyAgent::where('property_id', $id)->pluck('agent_id')->toArray();

    return view('Admin.Pages.properties.edit')->with([
      'title' => "Property Add",
      'categories' => $categories,
      'agents' => $agents,
      'types' => $types,
      'property' => $property,
      'PropertyDemographic' => $PropertyDemographic,
      'selectAgent' => $selectAgent,
      'status' => $status
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
      'state' => 'required',
      'city' => 'required',
      'square_foot' => 'required',
      'agent_id' => 'required',
      'image_relative_url' => 'image',
    ]);

    if ($validator->fails()) {
      return redirect()->back()->withErrors($validator)->withInput();
    }

    $property = Property::find($id);
    $property->name = $request->name;
    $property->state = $request->state;
    $property->city = $request->city;
    $property->square_foot = $request->square_foot;
    $property->property_type_id = $request->property_type_id;
    $property->property_status_id = $request->property_status_id;
    $property->address = $request->address;
    $property->longitude = $request->longitude;
    $property->latitude = $request->latitude;
    $property->gla = $request->gla;
    $property->description = $request->description;
    // $property->anchor_tenant = $request->anchor_tenant;
    $property->featured = $request->featured;
    $property->created_by_id = Auth::user()->id;
    $property->show_in_map = $request->show_in_map == 1 ? 1 : 0;
    $property->orderby_featured = $request->orderby_featured;

    if (!empty($property->anchor_tenant)) {
      $existFile = json_decode($property->anchor_tenant, true);
    } else {
      $existFile = [];
    }

    if ($request->has('anchor_tenant')) {
      foreach ($request->file('anchor_tenant') as $file) {
        $image_relative_url = $file;
        $fileName = $image_relative_url->hashName();
        if (File::exists(public_path('uploads/properties/anchor_tenant' . $fileName . ''))) {
          File::delete(public_path('uploads/properties/anchor_tenant' . $fileName . ''));
        }
        $image_relative_url->move(public_path('uploads/properties/anchor_tenant'), $fileName);
        if(is_array($existFile) && $fileName != null){
          array_push($existFile, $fileName);
        }
      }
      $property->anchor_tenant = json_encode($existFile);
    }

    if ($request->has('brochure_relative_url')) {
      if (File::exists(public_path('brochure_relative/' . $property->brochure_relative_url))) {
        File::delete(public_path('brochure_relative/' . $property->brochure_relative_url));
      }
      $brochure_relative_url = $request->file('brochure_relative_url');
      // $fileName = $brochure_relative_url->hashName();
      $fileName = $request->brochure_relative_url->getClientOriginalName();
      $fileName = str_replace(' ', '-', $fileName);
      $brochure_relative_url->move(public_path('brochure_relative'), $fileName);
      $property->brochure_relative_url = $fileName;
    }

    if ($request->has('site_plan_relative_url')) {
      if (File::exists(public_path('site_plan/' . $property->site_plan_relative_url))) {
        File::delete(public_path('site_plan/' . $property->site_plan_relative_url));
      }
      $site_plan_relative_url = $request->file('site_plan_relative_url');
      // $fileName = $site_plan_relative_url->hashName();
      $fileName = $request->site_plan_relative_url->getClientOriginalName();
      $fileName = str_replace(' ', '-', $fileName);
      $site_plan_relative_url->move(public_path('site_plan'), $fileName);
      $property->site_plan_relative_url = $fileName;
    }

    if ($request->has('image_relative_url')) {
      if (File::exists(public_path('property_image/' . $property->image_relative_url))) {
        File::delete(public_path('property_image/' . $property->image_relative_url));
      }
      $image_relative_url = $request->file('image_relative_url');
      $fileName = $image_relative_url->hashName();
      $image_relative_url->move(public_path('property_image'), $fileName);
      $property->image_relative_url = $fileName;
    }
    $property->save();

      // launch state update in background
      dispatch(function () use ($property){ GenerateShortStateNames::updatePropertyShortState( $property ); });

    PropertyAgent::where('property_id', $property->id)->delete();
    foreach ($request->agent_id as $key => $agentID) {
      $property->agents()->create(["agent_id" => $agentID]);
    }

    PropertyDemographic::where('property_id', $property->id)->delete();
    foreach ($request->demographic_mile as $key => $mileIDs) {
      foreach ($mileIDs as $key1 => $value) {
        $property->property_demographics()->create([
          "demographic_category_id" => $key,
          "demographic_mile_id" => $key1,
          "value" => $value,
        ]);
      }
    }

    if ($request->has('file')) {
      // PropertyPicture::where('property_id', $property->id)->delete();
      foreach ($request->file('file') as $key => $file) {
        $image_relative_url = $file;
        $fileName = $image_relative_url->hashName();
        if (File::exists(public_path('gallery/' . $fileName . ''))) {
          File::delete(public_path('gallery/' . $fileName . ''));
        }
        $image_relative_url->move(public_path('gallery'), $fileName);
        $property->property_pictures()->create([
          'image_relative_url' => $fileName,
          'image_order' => $request->image_order[$key],
        ]);
      }
    }

    return redirect()->back()->with('success', 'Property has been updated successfully.');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $property = Property::find($id);

    if (!$property) return redirect()->back()->with('error', 'Invalid request. Please try again');

    $property->delete();

    return response()->json([
      'status' => 'SUCCESS',
      'message' => 'Property has been deleted successfully'
    ]);
  }

  public function bulkDelete(Request $request)
  {
    if (empty($request->propertiesID)) return redirect()->back()->with('error', 'Please select a record/s to delete.');

    Property::whereIn('id', $request->propertiesID)->delete();

    return response()->json([
      'status' => 'SUCCESS',
      'message' => 'AgeProperties has been updated successfully.'
    ]);
  }

  public function deleteImage($id)
  {
    $image = PropertyPicture::find($id);

    if (!$image) return redirect()->back()->with('error', 'Invalid request. Please try again');

    $image->delete();

    return response()->json([
      'status' => 'SUCCESS',
      'message' => 'Gallery Image has been deleted successfully'
    ]);
  }

  public function deleteAnchorTenant($id, $name)
  {
    $property = Property::find($id);

    if (!$property) return redirect()->back()->with('error', 'Invalid request. Please try again');
    $images = json_decode($property->anchor_tenant);
    $images = (array) $images;

    if (($key = array_search($name, $images)) !== false) {
      unset($images[$key]);
    }
    if (File::exists(public_path('uploads/properties/anchor_tenant/' . $name . ''))) {
      File::delete(public_path('uploads/properties/anchor_tenant/' . $name . ''));
    }
    $existFileName = (array) $images;

    $property->anchor_tenant = json_encode($existFileName);
    $property->save();

    return response()->json([
      'status' => 'SUCCESS',
      'message' => 'Anchor tenant has been deleted successfully'
    ]);
  }

  public function removeDocument($id, $name)
  {
    $property = Property::find($id);

    if (!$property) return redirect()->back()->with('error', 'Invalid request. Please try again');

    if ($name == 'brochure_relative_url') {
      if (File::exists(public_path('brochure_relative/' . $property->brochure_relative_url))) {
        File::delete(public_path('brochure_relative/' . $property->brochure_relative_url));
      }
      $property->brochure_relative_url = null;
    }

    if ($name == 'site_plan_relative_url') {
      if (File::exists(public_path('site_plan/' . $property->site_plan_relative_url))) {
        File::delete(public_path('site_plan/' . $property->site_plan_relative_url));
      }
      $property->site_plan_relative_url = null;
    }

    if ($name == 'image_relative_url') {
      if (File::exists(public_path('property_image/' . $property->image_relative_url))) {
        File::delete(public_path('property_image/' . $property->image_relative_url));
      }
      $property->image_relative_url = null;
    }
    $property->save();

    return response()->json([
      'status' => 'SUCCESS',
      'message' => 'Image has been deleted successfully'
    ]);
  }

  public function changeImageOrder(Request $request, $id)
  {
    if (!empty($id) && !empty($request->image_order)) {
      PropertyPicture::where('id', $id)->update(['image_order' => $request->image_order]);
    } else {
      return response()->json([
        'status' => 'FAIL',
        'message' => 'Something went wrong, please try again.',
      ]);
    }
  }
}
