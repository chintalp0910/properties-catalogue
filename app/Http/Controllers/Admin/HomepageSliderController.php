<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\ModelsExtended\HomepageSlider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class HomepageSliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $slider = HomepageSlider::get();
        foreach ($slider as $key => $item) {
            $slider[$key]['value'] = json_decode($item->value);
        }
        
        return view('Admin.Pages.homepage_slider.addEdit', compact('slider'));
    }

    public function update(Request $request)
    {

        $slider = HomepageSlider::where('key', $request->slider)->first();

        if (is_null($slider)) {
            $validator = Validator::make($request->all(), [
                'hero_slider_title' => 'required_if:slider,hero_slider',
                'hero_slider' => 'required_if:slider,hero_slider',
                'carousel_slider__description' => 'required_if:slider,carousel_slider',
                'carousel_slider' => 'required_if:slider,carousel_slider',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
        }
        if (!$slider) {
            $slider = new HomepageSlider;
        };

        if ($request->slider == 'hero_slider') {
            $slider->title = $request->hero_slider_title;
            $slider->key = 'hero_slider';
            if (!empty($slider->value)) {
                $existFileName  = json_decode($slider->value);
                $existFileName = (array) $existFileName;
            } else {
                $existFileName = [];
            }
            $imgData = [];

            if ($request->has('hero_slider')) {
                foreach ($request->file('hero_slider') as $key => $file) {
                    $image_relative_url = $file;
                    $fileName = $image_relative_url->hashName();
                    if (File::exists(public_path('uploads/homepage/' . $fileName . ''))) {
                        File::delete(public_path('uploads/homepage/' . $fileName . ''));
                    }

                    $imgData['image'] = $fileName;
                    $imgData['order'] = $request->image_order[$key];
                    
                    array_push($existFileName, array_reverse($imgData));

                    $image_relative_url->move(public_path('uploads/homepage'), $fileName);
                    sleep(1);
                }
                $slider->value = json_encode($existFileName);
            }
            $slider->save();
        } else {
            // dd($request->all());
            $slider->title = $request->carousel_slider__description;
            $slider->key = 'carousel_slider';
            if (!empty($slider->value)) {
                $existFile  = json_decode($slider->value);
                $existFile = (array) $existFile;
            } else {
                $existFile = [];
            }

            $imgData = [];

            if ($request->has('carousel_slider')) {
                foreach ($request->file('carousel_slider') as $key => $file) {
                    $image_relative_url = $file;
                    $fileName = $image_relative_url->hashName();
                    if (File::exists(public_path('uploads/homepage/' . $fileName . ''))) {
                        File::delete(public_path('uploads/homepage/' . $fileName . ''));
                    }

                    $imgData['image'] = $fileName;
                    $imgData['order'] = $request->carousel_slider_order[$key];
                    
                    array_push($existFile, array_reverse($imgData));

                    $image_relative_url->move(public_path('uploads/homepage'), $fileName);
                }
                $slider->value = json_encode($existFile);
            }
            $slider->save();
        }

        return redirect()->back()->with('success', 'Homepage slider has been updated successfully.');
    }


    public function deleteSlider($id, $name)
    {
        $slider = HomepageSlider::find($id);

        if (!$slider) return redirect()->back()->with('error', 'Invalid request. Please try again');
        $images = json_decode($slider->value, true);

        $temp = [];
        foreach ($images as $img) {
            if($img['image'] == $name){
                unset($img['image']);
                unset($img['order']);
            }
            array_push($temp, $img);
        }

        // $images = (array) $images;
        // if (($key = array_search($name, $images)) !== false) {
        //     unset($images[$key]);
        // }
        
        if (File::exists(public_path('uploads/homepage/' . $name . ''))) {
            File::delete(public_path('uploads/homepage/' . $name . ''));
        }
        // $existFileName = (array) $images;
        
        $slider->value = json_encode(array_filter($temp));
        $slider->save();

        return response()->json([
            'status' => 'SUCCESS',
            'message' => 'Slider Image has been deleted successfully'
        ]);
    }

    public function changeSliderOrder(Request $request, $id, $name){
        
        $slider = HomepageSlider::find($id);

        if(!$slider){
            return response()->json([
                'status' => 'FAIL',
                'message' => 'Something went wrong, please try again.',
              ]);
        }
        
        $images = json_decode($slider->value, true);

        $array = [];
        foreach ($images as $img) {
            if($img['image'] == $name){
                $img['order'] = $request->slider_order;
            }
            array_push($array, $img);
        }

        $slider->value = json_encode(array_filter($array));
        $slider->save();

        return response()->json([
            'status' => 'SUCCESS',
            'message' => 'Slider order has been deleted successfully'
        ]);
    }
}
