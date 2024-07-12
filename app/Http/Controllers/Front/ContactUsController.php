<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Mail\ContactUsMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ContactUsController extends Controller
{
    public function index()
    {
        $setting = \Config::get('settings');
        $office_title1 = array_key_exists('office_title1', $setting) ? strip_tags($setting['office_title1']) : '';
        $office_title2 = array_key_exists('office_title2', $setting) ? strip_tags($setting['office_title2']) : '';

        return view('Front.contact_us',[
            'og_title' => 'Contact Us - Paramount Realty',
            'og_description' => 'Contact Us - Paramount Realty, '.$office_title1.', '.$office_title2,
        ]);
    }

    public function sendMail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required|email',
            'number' => 'required',
            'subject' => 'required',
            'message' => 'required',
            'captcha' => 'required|captcha',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        $data = [
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'number' => $request->number,
            'subject' => $request->subject,
            'message' => $request->message,
        ];

        Mail::to(env('CONTACT_US_EMAIL_RECEIVER'))->send(new ContactUsMail($data));

        return redirect()->back()->with('success', 'Thanks for connecting with us, we will get back to you shortly.');
    }

    public function reloadCaptcha()
    {
        return response()->json(['captcha' => captcha_img()]);
    }
}
