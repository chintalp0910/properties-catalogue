<?php

namespace App\Http\Controllers\Admin\Properties;

use App\Http\Controllers\Controller;
use App\ModelsExtended\Property;
use Illuminate\Http\Request;

class AddPropertyController extends Controller
{
    public function saveDemographic( Property $property , Request $request)
    {
        $this->validate( $request, [
            'demographic_category_id' => 'required|exists:demographic_category,id',
            'demographic_mile_id' => 'required|exists:demographic_mile,id',
            'value' => 'required'
        ] );

        $property->property_demographics()->updateOrCreate([
            'demographic_category_id' => $request->input('demographic_category_id' ),
            'demographic_mile_id'  => $request->input('demographic_mile_id' ),
        ],[
            'value' => $request->input('value' )
        ]);
    }
}
