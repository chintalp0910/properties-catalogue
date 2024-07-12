<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\DemographicCategory;
use App\Models\Property;
use App\ModelsExtended\PropertyStatus;
use App\ModelsExtended\PropertyType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;


class ShoppingCenterController extends Controller
{
    public function shoppingCenter()
    {
        return view('Front.shopping_center');
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $propertyName = $request->property_name;
            $state = $request->state;
            $city = $request->city;
            $property_types = $request->property_types;

            $properties = Property::with('property_pictures')->where('property_status_id', 1)->orderBy("a4a_sort", "asc")->where(function ($query) use ($propertyName) {
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
            })->orderBy("a4a_sort", "asc")->paginate(15)->withQueryString();

            $html = '';
            $data = [];
            $src = '';
            if ($properties->count() > 0) {
                foreach ($properties as $propery) {
                    if (!empty($propery->image_relative_url) && File::exists(public_path('property_image/' . $propery->image_relative_url . ''))) {
                        $src = asset('property_image/' . $propery->image_relative_url . '');
                    } else {
                        $src = asset('assets/front/images/propery_image.png');
                    }
                    $html = '<div class="our-properties-wrap col-lg-4 col-sm-6">';
                    $html .= '<a href="' . route('shoppingCenter.view', $propery->slug) . '">';
                    $html .= '<div class="properties-inner position-relative background" style="background-image: url(' . $src . ')">';
                    $html .= '<div class="content">';
                    $html .= '<div class="left-content">';
                    $html .= '<h3>' . $propery->name . '</h3>';
                    // $html .= '<span>' . $propery->address ?? '' . '</span>';
                    // if (!empty($propery->gla)) {
                    //     $html .= '<p>GLA: ' . number_format($propery->gla) . '</p>';
                    // }
                    if (!empty($propery->city) || !empty($propery->short_state_name) || !empty($propery->gla)) {
                        $html .= '<span>';
                        if (!empty($propery->city)) {
                            $html .=  $propery->city;
                        }
                        if (!empty($propery->short_state_name)) {
                            $html .= ', ' . $propery->short_state_name;
                        }
                        if (!empty($propery->gla)) {
                            $html .= ", GLA – " . number_format($propery->gla);
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
                $html = '';
                $html .= '' . $properties->links('pagination::bootstrap-4') . '';
                array_push($data, $html);
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


            $properties = Property::with('property_pictures')->where('property_status_id', 1)->orderBy("a4a_sort", "asc")->where(function ($query) use ($propertyName) {
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
            })->paginate(15)->withQueryString();
            $propertyTypes = PropertyType::get();

            return view('Front.shopping_center', [
                'properties' => $properties,
                'propertyTypes' => $propertyTypes,
                'propertyName' => $propertyName,
                'state' => $state,
                'city' => $city,
                'property_types' => $property_types,
            ]);
        }
        else {
            $properties = Property::with('property_pictures')
                ->where('property_status_id', PropertyStatus::ACTIVE)
                ->where('property_type_id', PropertyType::SHOPPING_CENTER)
                ->orderBy("a4a_sort", "asc")->paginate(15);
            $propertyTypes = PropertyType::get();

            return view('Front.shopping_center', [
                'properties' => $properties,
                'propertyTypes' => $propertyTypes,
            ]);
        }
    }

    public function shoppingCenterView($slug)
    {
        $property = Property::with(['property_pictures', 'property_demographics', 'agents'])->where('slug', $slug)->first();
        $demoCategories = DemographicCategory::get();
        $property->anchor_tenant = json_decode($property->anchor_tenant);
        return view('Front.properties_view', [
            'property' => $property,
            'demoCategories' => $demoCategories,
            'og_title' => $property->name,
            'og_description' => $property->description,
            'og_image' => !empty($property->image_relative_url) && File::exists(public_path('property_image/' . $property->image_relative_url . '')) ? asset('property_image/' . $property->image_relative_url . '') : '',
        ]);
    }
}
