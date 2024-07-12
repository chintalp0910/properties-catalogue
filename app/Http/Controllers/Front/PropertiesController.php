<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\DemographicCategory;
use App\Models\Property;
use App\Models\PropertyType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PropertiesController extends Controller
{

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $propertyName = $request->property_name;
            $state = $request->state;
            $city = $request->city;
            $property_types = $request->property_types;

            $properties = Property::with('property_pictures')->where('property_status_id', 1)->orderBy("gla", "desc")->where(function ($query) use ($propertyName) {
                if (!empty($propertyName)) {
                    $query->where('name', 'like', '%' . $propertyName . '%');
                }
            })->where(function ($query) use ($state) {
                if (!empty($state)) {
                    $query->where('state', 'like', '%' . $state . '%');
                }
            })->where(function ($query) use ($city) {
                if (!empty($city)) {
                    $query->where('city', 'like', '%' . $city . '%');
                }
            })->where(function ($query) use ($property_types) {
                if (!empty($property_types) && $property_types != 'ALL') {
                    $query->where('property_type_id', $property_types);
                }
            })->orderBy("gla", "desc")->get();

            $html = '';
            $data = [];
            $src = '';
            if ($properties->count() > 0) {
                foreach ($properties as $property) {
                    if (!empty($property->image_relative_url) && File::exists(public_path('property_image/' . $property->image_relative_url . ''))) {
                        $src = asset('property_image/' . $property->image_relative_url . '');
                    } else {
                        $src = asset('assets/front/images/propery_image.png');
                    }
                    $html = '<div class="our-properties-wrap col-lg-4 col-sm-6" id="' . $property->slug . '">';
                    $html .= '<a href="' . route('properties.view', $property->slug) . '">';
                    $html .= '<div class="properties-inner position-relative background" style="background-image: url(' . $src . ')">';
                    $html .= '<div class="content">';
                    $html .= '<div class="left-content">';
                    $html .= '<h3>' . $property->name . '</h3>';
                    if (!empty($property->city) || !empty($property->short_state_name) || !empty($property->gla)) {
                        $html .= '<span>';
                        if (!empty($property->city)) {
                            $html .=  $property->city;
                        }
                        if (!empty($property->short_state_name)) {
                            $html .= ', ' . $property->short_state_name;
                        }
                        if (!empty($property->gla)) {
                            $html .= ", GLA – " . number_format($property->gla);
                        }
                        $html .= '</span>';
                    }
                    // $html .= '<span>' . $property->address ?? '' . '</span>';
                    // if (!empty($property->gla)) {
                    //     $html .= '<p>GLA: ' . number_format($property->gla) . '</p>';
                    // }
                    $html .= ' </div>';
                    $html .= '<div class="button-1">';
                    $html .= 'VIEW';
                    $html .= '</div>';
                    $html .= '</div>';
                    $html .= '</div>';
                    $html .= '</a>';
                    $html .= '</div>';
                    array_push($data, $html);
                }
                // array_push($data, $html);
            }

            return response()->json([
                'status' => 'SUCCESS',
                'data' => $data,
            ]);
        }

        if (!empty($request->all())) {
            $propertyName = $request->property_name;
            $state = $request->state;
            $city = $request->city;
            $property_types = $request->property_types;
            $properties = Property::with('property_pictures')->where('property_status_id', 1)->orderBy("gla", "desc")->where(function ($query) use ($propertyName) {
                if (!empty($propertyName)) {
                    $query->where('name', 'like', '%' . $propertyName . '%');
                }
            })->where(function ($query) use ($state) {
                if (!empty($state)) {
                    $query->where('state', 'like', '%' . $state . '%');
                }
            })->where(function ($query) use ($city) {
                if (!empty($city)) {
                    $query->where('city', 'like', '%' . $city . '%');
                }
            })->where(function ($query) use ($property_types) {
                if (!empty($property_types) && $property_types != 'ALL') {
                    $query->where('property_type_id', $property_types);
                }
            })->get();
            $propertyTypes = PropertyType::get();

            return view('Front.properties', [
                'properties' => $properties,
                'propertyTypes' => $propertyTypes,
                'propertyName' => $propertyName,
                'state' => $state,
                'city' => $city,
                'property_types' => $property_types,
            ]);
        } else {
            $properties = Property::with('property_pictures')->where('property_status_id', 1)->orderBy("gla", "desc")->get();
            $propertyTypes = PropertyType::get();

            return view('Front.properties', [
                'properties' => $properties,
                'propertyTypes' => $propertyTypes,
                'og_title' => 'Properties - Paramount Realty',
                'og_description' => 'Properties -Paramount Realty',
            ]);
        }
    }

    public function propertiesView($slug)
    {
        $property = Property::with(['property_pictures', 'property_demographics', 'agents'])->where('slug', $slug)->first();
        $demoCategories = DemographicCategory::orderBy('id', 'ASC')->get();

        $property->anchor_tenant = json_decode($property->anchor_tenant);

        return view('Front.properties_view', [
            'property' => $property,
            'demoCategories' => $demoCategories,
            'og_title' => $property->name,
            'og_description' => $property->description,
            'og_image' => !empty($property->image_relative_url) && File::exists(public_path('property_image/' . $property->image_relative_url . '')) ? asset('property_image/' . $property->image_relative_url . '') : '',
        ]);
    }

    public function propertiesSearch(Request $request)
    {
        $search = $request->search;
        $properties = Property::where('name', 'like', '%' . $search . '%')
            ->orWhere('state', 'like', '%' . $search . '%')
            ->orWhere('city', 'like', '%' . $search . '%')
            ->with('property_pictures')->where('property_status_id', 1)
            ->orderBy("gla", "desc")->paginate(15)->withQueryString();

        $propertyTypes = PropertyType::get();

        return view('Front.properties', [
            'properties' => $properties,
            'propertyTypes' => $propertyTypes,
            'propertyName' => $search,
        ]);
    }

    public function mapView(Request $request)
    {

        if ($request->ajax()) {
            $propertyName = $request->property_name;
            $state = $request->state;
            $city = $request->city;
            $property_types = $request->property_types;

            $properties = Property::select('slug', 'name', 'image_relative_url', 'address', 'square_foot', 'latitude', 'longitude')->where('latitude', '!=', ' ')->where('longitude', '!=', ' ')->where(function ($query) use ($propertyName) {
                if (!empty($propertyName)) {
                    $query->where('name', 'like', '%' . $propertyName . '%');
                }
            })->where(function ($query) use ($state) {
                if (!empty($state)) {
                    $query->where('state', 'like', '%' . $state . '%');
                }
            })->where(function ($query) use ($city) {
                if (!empty($city)) {
                    $query->where('city', 'like', '%' . $city . '%');
                }
            })->where(function ($query) use ($property_types) {
                if (!empty($property_types) && $property_types != 'ALL') {
                    $query->where('property_type_id', $property_types);
                }
            })->get()->toArray();

            foreach ($properties as $key => $property) {
                $properties[$key]['image_relative_url'] = !empty($property['image_relative_url']) && File::exists(public_path('property_image/' . $property['image_relative_url'])) ? asset('property_image/' . $property['image_relative_url']) : asset('assets/front/images/propery_image.png');
                $properties[$key]['name'] = ucwords(str_replace("'", ' ', $property['name']));
                $properties[$key]['url'] = route('properties.view', $property['slug']);
            }

            return response()->json([
                'status' => 'SUCCESS',
                'data' => $properties,
            ]);
        }

        $properties = Property::select('slug', 'name', 'image_relative_url', 'address', 'square_foot', 'latitude', 'longitude')->where('latitude', '!=', ' ')->where('longitude', '!=', ' ')->get()->toArray();
        $propertyTypes = PropertyType::get();

        foreach ($properties as $key => $property) {
            $properties[$key]['image_relative_url'] = !empty($property['image_relative_url']) && File::exists(public_path('property_image/' . $property['image_relative_url'])) ? asset('property_image/' . $property['image_relative_url']) : asset('assets/front/images/propery_image.png');
            $properties[$key]['name'] = str_replace("'", ' ', $property['name']);
            $properties[$key]['url'] = route('properties.view', $property['slug']);
        }
        return view('Front.properties_map_view', [
            'properties' => $properties,
            'propertyTypes' => $propertyTypes,
        ]);
    }

    public function underDevelopment(Request $request)
    {
        if ($request->ajax()) {
            $propertyName = $request->property_name;
            $state = $request->state;
            $city = $request->city;
            $property_types = $request->property_types;

            $properties = Property::with('property_pictures')->where('property_status_id', 1)->where('under_development', 1)->orderBy("gla", "desc")->where(function ($query) use ($propertyName) {
                if (!empty($propertyName)) {
                    $query->where('name', 'like', '%' . $propertyName . '%');
                }
            })->where(function ($query) use ($state) {
                if (!empty($state)) {
                    $query->where('state', 'like', '%' . $state . '%');
                }
            })->where(function ($query) use ($city) {
                if (!empty($city)) {
                    $query->where('city', 'like', '%' . $city . '%');
                }
            })->where(function ($query) use ($property_types) {
                if (!empty($property_types) && $property_types != 'ALL') {
                    $query->where('property_type_id', $property_types);
                }
            })->orderBy("gla", "desc")->get();

            $html = '';
            $data = [];
            $src = '';
            if ($properties->count() > 0) {
                foreach ($properties as $property) {
                    if (!empty($property->image_relative_url) && File::exists(public_path('property_image/' . $property->image_relative_url . ''))) {
                        $src = asset('property_image/' . $property->image_relative_url . '');
                    } else {
                        $src = asset('assets/front/images/propery_image.png');
                    }
                    $html = '<div class="our-properties-wrap col-lg-4 col-sm-6" id="' . $property->slug . '">';
                    $html .= '<a href="' . route('properties.view', $property->slug) . '">';
                    $html .= '<div class="properties-inner position-relative background" style="background-image: url(' . $src . ')">';
                    $html .= '<div class="content">';
                    $html .= '<div class="left-content">';
                    $html .= '<h3>' . $property->name . '</h3>';
                    // $html .= '<span>' . $property->address ?? '' . '</span>';
                    // if (!empty($property->gla)) {
                    //     $html .= '<p>GLA: ' . number_format($property->gla) . '</p>';
                    // }
                    if (!empty($property->city) || !empty($property->short_state_name) || !empty($property->gla)) {
                        $html .= '<span>';
                        if (!empty($property->city)) {
                            $html .=  $property->city;
                        }
                        if (!empty($property->short_state_name)) {
                            $html .= ', ' . $property->short_state_name;
                        }
                        if (!empty($property->gla)) {
                            $html .= ", GLA – " . number_format($property->gla);
                        }
                        $html .= '</span>';
                    }
                    $html .= ' </div>';
                    $html .= '<div class="button-1">';
                    $html .= 'VIEW';
                    $html .= '</div>';
                    $html .= '</div>';
                    $html .= '</div>';
                    $html .= '</a>';
                    $html .= '</div>';
                    array_push($data, $html);
                }
                // array_push($data, $html);
            }

            return response()->json([
                'status' => 'SUCCESS',
                'data' => $data,
            ]);
        }

        $properties = Property::with('property_pictures')->where('under_development', 1)->where('property_status_id', 1)->orderBy("gla", "desc")->get();
        $propertyTypes = PropertyType::get();

        return view('Front.properties', [
            'properties' => $properties,
            'propertyTypes' => $propertyTypes,
        ]);
    }

    public function getProperties(Request $request, $type)
    {
        $type = str_replace('-', ' ', $type);
        $type = ucwords($type);

        if ($type == 'Single Tenant') {
            $oredr = "name";
            $oredr_by = "asc";
        } else {
            $oredr = "gla";
            $oredr_by = "desc";
        }

        $propertyType = PropertyType::where('description', $type)->first();

        if (!$propertyType) return redirect()->back()->with('error', 'Invalid request, Please try again.');

        if ($request->ajax()) {
            $propertyName = $request->property_name;
            $state = $request->state;
            $city = $request->city;
            $property_types = $request->property_types;

            $properties = Property::with('property_pictures')->where('property_type_id', $propertyType->id)->where('property_status_id', 1)->where(function ($query) use ($propertyName) {
                if (!empty($propertyName)) {
                    $query->where('name', 'like', '%' . $propertyName . '%');
                }
            })->where(function ($query) use ($state) {
                if (!empty($state)) {
                    $query->where('state', 'like', '%' . $state . '%');
                }
            })->where(function ($query) use ($city) {
                if (!empty($city)) {
                    $query->where('city', 'like', '%' . $city . '%');
                }
            })->where(function ($query) use ($property_types) {
                if (!empty($property_types) && $property_types != 'ALL') {
                    $query->where('property_type_id', $property_types);
                }
            })->orderBy($oredr, $oredr_by)->get();

            $html = '';
            $data = [];
            $src = '';
            if ($properties->count() > 0) {
                foreach ($properties as $property) {
                    if (!empty($property->image_relative_url) && File::exists(public_path('property_image/' . $property->image_relative_url . ''))) {
                        $src = asset('property_image/' . $property->image_relative_url . '');
                    } else {
                        $src = asset('assets/front/images/propery_image.png');
                    }
                    $html = '<div class="our-properties-wrap col-lg-4 col-sm-6" id="' . $property->slug . '">';
                    $html .= '<a href="' . route('properties.view', $property->slug) . '">';
                    $html .= '<div class="properties-inner position-relative background" style="background-image: url(' . $src . ')">';
                    $html .= '<div class="content">';
                    $html .= '<div class="left-content">';
                    $html .= '<h3>' . $property->name . '</h3>';
                    if (!empty($property->city) || !empty($property->short_state_name) || !empty($property->gla)) {
                        $html .= '<span>';
                        if (!empty($property->city)) {
                            $html .=  $property->city;
                        }
                        if (!empty($property->short_state_name)) {
                            $html .= ', ' . $property->short_state_name;
                        }
                        if (!empty($property->gla)) {
                            $html .= ", GLA – " . number_format($property->gla);
                        }
                        $html .= '</span>';
                    }
                    $html .= ' </div>';
                    $html .= '<div class="button-1">';
                    $html .= 'VIEW';
                    $html .= '</div>';
                    $html .= '</div>';
                    $html .= '</div>';
                    $html .= '</a>';
                    $html .= '</div>';
                    array_push($data, $html);
                }
            }

            return response()->json([
                'status' => 'SUCCESS',
                'data' => $data,
            ]);
        }

        if (!empty($request->all())) {
            $propertyName = $request->property_name;
            $state = $request->state;
            $city = $request->city;
            $property_types = $request->property_types;
            $properties = Property::with('property_pictures')->where('property_type_id', $propertyType->id)->where('property_status_id', 1)->orderBy("gla", "desc")->where(function ($query) use ($propertyName) {
                if (!empty($propertyName)) {
                    $query->where('name', 'like', '%' . $propertyName . '%');
                }
            })->where(function ($query) use ($state) {
                if (!empty($state)) {
                    $query->where('state', 'like', '%' . $state . '%');
                }
            })->where(function ($query) use ($city) {
                if (!empty($city)) {
                    $query->where('city', 'like', '%' . $city . '%');
                }
            })->where(function ($query) use ($property_types) {
                if (!empty($property_types) && $property_types != 'ALL') {
                    $query->where('property_type_id', $property_types);
                }
            })->get();
            $propertyTypes = PropertyType::get();

            return view('Front.properties', [
                'properties' => $properties,
                'propertyTypes' => $propertyTypes,
                'propertyName' => $propertyName,
                'state' => $state,
                'city' => $city,
                'property_types' => $property_types,
            ]);
        } else {
            $properties = Property::with('property_pictures')->where('property_type_id', $propertyType->id)->where('property_status_id', 1)->orderBy($oredr, $oredr_by)->get();
            $propertyTypes = PropertyType::get();

            return view('Front.properties', [
                'properties' => $properties,
                'propertyTypes' => $propertyTypes,
                'og_title' => $type.' - Paramount Realty',
                'og_description' => $type.' - Paramount Realty',
            ]);
        }
    }

    public function splitView(Request $request)
    {
        if ($request->ajax()) {
            $propertyName = $request->property_name;
            $state = $request->state;
            $city = $request->city;
            $property_types = $request->property_types;

            $properties = Property::with('property_pictures')->where('property_status_id', 1)
                ->where('show_in_map', 1)
                ->orderBy("gla", "desc")
                ->where(function ($query) use ($propertyName) {
                    if (!empty($propertyName)) {
                        $query->where('name', 'like', '%' . $propertyName . '%');
                    }
                })->where(function ($query) use ($state) {
                    if (!empty($state)) {
                        $query->where('state', 'like', '%' . $state . '%');
                    }
                })->where(function ($query) use ($city) {
                    if (!empty($city)) {
                        $query->where('city', 'like', '%' . $city . '%');
                    }
                })->where(function ($query) use ($property_types) {
                    if (!empty($property_types) && $property_types != 'ALL') {
                        $query->where('property_type_id', $property_types);
                    }
                })->orderBy("gla", "desc")->get();

            $html = '';
            $data = [];
            $mapProperties = [];
            $src = '';
            if ($properties->count() > 0) {
                foreach ($properties as $property) {
                    if (!empty($property->image_relative_url) && File::exists(public_path('property_image/' . $property->image_relative_url . ''))) {
                        $src = asset('property_image/' . $property->image_relative_url . '');
                    } else {
                        $src = asset('assets/front/images/propery_image.png');
                    }
                    $html = '<div class="our-properties-wrap col-lg-4 col-sm-6" id="' . $property->slug . '">';
                    $html .= '<a href="' . route('properties.view', $property->slug) . '">';
                    $html .= '<div class="properties-inner position-relative background" style="background-image: url(' . $src . ')">';
                    $html .= '<div class="content">';
                    $html .= '<div class="left-content">';
                    $html .= '<h3>' . $property->name . '</h3>';
                    if (!empty($property->city) || !empty($property->short_state_name) || !empty($property->gla)) {
                        $html .= '<span>';
                        if (!empty($property->city)) {
                            $html .=  $property->city;
                        }
                        if (!empty($property->short_state_name)) {
                            $html .= ', ' . $property->short_state_name;
                        }
                        if (!empty($property->gla)) {
                            $html .= ", GLA – " . number_format($property->gla);
                        }
                        $html .= '</span>';
                    }
                    $html .= ' </div>';
                    $html .= '<div class="button-1">';
                    $html .= 'VIEW';
                    $html .= '</div>';
                    $html .= '</div>';
                    $html .= '</div>';
                    $html .= '</a>';
                    $html .= '</div>';
                    array_push($data, $html);
                }

                $mapProperties = Property::select('slug', 'name', 'image_relative_url', 'address', 'square_foot', 'latitude', 'longitude')->where('latitude', '!=', ' ')->where('longitude', '!=', ' ')
                    ->where('show_in_map', 1)->where(function ($query) use ($propertyName) {
                        if (!empty($propertyName)) {
                            $query->where('name', 'like', '%' . $propertyName . '%');
                        }
                    })->where(function ($query) use ($state) {
                        if (!empty($state)) {
                            $query->where('state', 'like', '%' . $state . '%');
                        }
                    })->where(function ($query) use ($city) {
                        if (!empty($city)) {
                            $query->where('city', 'like', '%' . $city . '%');
                        }
                    })->where(function ($query) use ($property_types) {
                        if (!empty($property_types) && $property_types != 'ALL') {
                            $query->where('property_type_id', $property_types);
                        }
                    })->get()->toArray();

                foreach ($mapProperties as $key => $property) {
                    $mapProperties[$key]['image_relative_url'] = !empty($property['image_relative_url']) && File::exists(public_path('property_image/' . $property['image_relative_url'])) ? asset('property_image/' . $property['image_relative_url']) : asset('assets/front/images/propery_image.png');
                    $mapProperties[$key]['name'] = ucwords(str_replace("'", ' ', $property['name']));
                    $mapProperties[$key]['url'] = route('properties.view', $property['slug']);
                }
            }

            return response()->json([
                'status' => 'SUCCESS',
                'data' => $data,
                'mapProperties' => $mapProperties,
            ]);
        }

        $properties = Property::with('property_pictures')
            ->where('property_status_id', 1)->where('show_in_map', 1)->orderBy("gla", "desc")->get();
        $propertyTypes = PropertyType::get();

        $mapProperties = Property::select('slug', 'name', 'image_relative_url', 'address', 'square_foot', 'latitude', 'longitude')->where('show_in_map', 1)->where('latitude', '!=', ' ')->where('longitude', '!=', ' ')->get()->toArray();
        foreach ($mapProperties as $key => $property) {
            $mapProperties[$key]['image_relative_url'] = !empty($property['image_relative_url']) && File::exists(public_path('property_image/' . $property['image_relative_url'])) ? asset('property_image/' . $property['image_relative_url']) : asset('assets/front/images/propery_image.png');
            $mapProperties[$key]['name'] = str_replace("'", ' ', $property['name']);
            $mapProperties[$key]['address'] = str_replace("'", ' ', $property['address']);
            $mapProperties[$key]['url'] = route('properties.view', $property['slug']);
        }

        return view('Front.properties_split_view', [
            'action' => 'LIST',
            'properties' => $properties,
            'propertyTypes' => $propertyTypes,
            'mapProperties' => $mapProperties,
        ]);
    }
}
