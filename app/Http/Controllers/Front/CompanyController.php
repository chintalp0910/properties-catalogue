<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Property;
use App\Models\PropertyType;
use Illuminate\Support\Facades\File;
use App\ModelsExtended\CompanyPageAvatar;
use App\ModelsExtended\CompanySetting;

class CompanyController extends Controller
{
    public function index()
    {
        $properties = Property::select('slug', 'name', 'image_relative_url', 'address', 'square_foot', 'latitude', 'longitude')->where('latitude', '!=', ' ')->where('longitude', '!=', ' ')->where('show_in_map', 1)->get()->toArray();
        $propertyTypes = PropertyType::get();

        foreach ($properties as $key => $property) {
            $properties[$key]['image_relative_url'] = !empty($property['image_relative_url']) && File::exists(public_path('property_image/' . $property['image_relative_url'])) ? asset('property_image/' . $property['image_relative_url']) : asset('assets/front/images/propery_image.png');
            $properties[$key]['name'] = str_replace("'", ' ', $property['name']);
            $properties[$key]['url'] = route('properties.view', $property['slug']);
        }

        $companySetting =  CompanySetting::first();

        return view('Front.company', [
            'properties' => $properties,
            'propertyTypes' => $propertyTypes,
            'companySetting' => $companySetting,
            'og_title' => 'Companies - Paramount Realty',
            'og_description' => isset($companySetting) && !empty($companySetting->description) ? $companySetting->description : 'Companies - Paramount Realty',
        ])->with("avatars", CompanyPageAvatar::orderBy('sort_order', 'ASC')->get());
    }
}
