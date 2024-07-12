<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\ModelsExtended\CompanyPageAvatar;
use App\ModelsExtended\CompanySetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class SettingsController extends Controller
{
    public function index()
    {
        $setting = Setting::get();
        $value = [];
        foreach ($setting as  $item) {
            $value[$item->key] = $item->val;
        }
        return view('Admin.Pages.setting', compact('value'));
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'office_title1' => 'required',
            'office_address1' => 'required',
            'office_title2' => 'required',
            'office_address2' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        foreach ($request->all() as $key => $val) {

            if ($val == '') {
                Setting::where('key', $key)->delete();
            }

            if ($key == '_token' || $key == '_method' || $val == '' || $key == 'action' || $key == 'image_class') continue;
            $setting = Setting::where('key', $key)->first();

            if (!$setting) {
                $setting = new Setting;
            };

            /*if ($key == 'company_page_hero_images') {
                if (!empty($setting->val)) {
                    $existFileName  = json_decode($setting->val);
                    $existFileName = (array) $existFileName;
                } else {
                    $existFileName = [];
                }
                $imgData = [];

                foreach ($request->file('company_page_hero_images') as $key1 => $file) {
                    $image_relative_url = $file;
                    $fileName = date('Y-m-d H:i:s') . '_' . $image_relative_url->getClientOriginalName();
                    $fileName  = str_replace(' ', '_', $fileName);

                    if (File::exists(public_path('uploads/setting/' . $fileName . ''))) {
                        File::delete(public_path('uploads/setting/' . $fileName . ''));
                    }

                    $imgData['image'] = $fileName;
                    $imgData['image_class'] = $request->image_class[$key1];

                    array_push($existFileName, array_reverse($imgData));

                    $image_relative_url->move(public_path('uploads/setting'), $fileName);
                    sleep(1);
                }

                $setting->key = $key;
                $setting->val = json_encode($existFileName);
            }*/

            if ($key == 'header_logo' || $key == 'footer_logo') {
                if (File::exists(public_path('uploads/setting/' . $setting->val . ''))) {
                    File::delete(public_path('uploads/setting/' . $setting->val . ''));
                }
                if ($key == 'header_logo') {
                    $image_relative_url = $val;
                }
                if ($key == 'footer_logo') {
                    $image_relative_url = $val;
                }

                $fileName = $image_relative_url->hashName();
                $image_relative_url->move(public_path('uploads/setting'), $fileName);
                $setting->key = $key;
                $setting->val = $fileName;
            } else {
                $setting->key = $key;
                $setting->val = $val;
            }
            $setting->save();
        }
        return redirect()->back()->with('success', 'Settings has been updated successfully.');
    }

    public function companyPage()
    {
        return view('Admin.Pages.companypage_settings')
            ->with("companySetting", CompanySetting::getSetting())
            ->with("avatars", CompanyPageAvatar::all());
    }

    public function deleteCompanyPageAvatar($id)
    {
        $image = CompanyPageAvatar::find($id);

        if (!$image) return redirect()->back()->with('error', 'Invalid request. Please try again');

        $image->delete();

        return response()->json([
            'status' => 'SUCCESS',
            'message' => 'Image has been deleted successfully'
        ]);
    }

    public function changeImageColorAndOrder(Request $request, $id)
    {
        $image = CompanyPageAvatar::find($id);
        if (!$image) {
            return response()->json([
                'status' => 'FAIL',
                'message' => 'Something went wrong, please try again.',
            ]);
        }

        if(!empty($request->sort_order)) $image->sort_order = $request->sort_order;
        if(!empty($request->image_color)) $image->image_color = $request->image_color;
        $image->save();

        return response()->json([
            'status' => 'SUCCESS',
            'message' => 'Image class has been deleted successfully'
        ]);
    }

    public function updateCompanyPageSetting(Request $request)
    {
        $setting = CompanySetting::getSetting();

        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $setting->title = $request->title;
        $setting->description = $request->description;

        if ($request->has('p_image')) {
            if (File::exists(public_path('uploads/setting/company/' . $setting->p_image))) {
                File::delete(public_path('uploads/setting/company/' . $setting->p_image));
            }
            $p_image = $request->file('p_image');
            $fileName = $request->p_image->getClientOriginalName();
            $fileName = str_replace(' ', '-', $fileName);
            $p_image->move(public_path('uploads/setting/company'), $fileName);
            $setting->p_image = $fileName;
        }

        if ($request->has('map_image')) {
            if (File::exists(public_path('uploads/setting/company/' . $setting->map_image))) {
                File::delete(public_path('uploads/setting/company/' . $setting->map_image));
            }
            $map_image = $request->file('map_image');
            $fileName = $request->map_image->getClientOriginalName();
            $fileName = str_replace(' ', '-', $fileName);
            $map_image->move(public_path('uploads/setting/company'), $fileName);
            $setting->map_image = $fileName;
        }
        $setting->save();

        if ($request->has('image_name')) {
            foreach ($request->file('image_name') as $key => $file) {
                $image_relative_url = $file;
                $fileName = $image_relative_url->hashName();
                if (File::exists(public_path('assets/front/images/' . $fileName . ''))) {
                    File::delete(public_path('assets/front/images/' . $fileName . ''));
                }
                $image_relative_url->move(public_path('assets/front/images'), $fileName);
                $image = new CompanyPageAvatar;
                $image->image_name = $fileName;
                $image->sort_order = intval($request->sort_order_1[$key])===0? 999 : intval($request->sort_order_1[$key]);
                $image->image_color = Str::of(strval($request->image_color_1[$key]))->length()? $request->image_color_1[$key] : '#ffffff';
                $image->save();
                sleep(1);
            }
        }

        return redirect()->back()->with('success', 'Settings has been updated successfully.');
    }
}
