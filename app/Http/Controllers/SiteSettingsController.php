<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SiteSettingsController extends Controller
{
    public function index()
    {
        $settings = siteSettings()::first();
        return view('backEnd.settings.site_settings', compact('settings'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'company_name' => 'required|string|max:255',
            'mobile' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'address' => 'nullable|string|max:500',
            'copy_right_text' => 'required|string|max:255',
            'company_main_logo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'company_mini_logo' => 'nullable|image|mimes:jpeg,png,jpg|max:1024',
            'favicon' => 'nullable|mimes:ico,png|max:1024'
        ]);

        $settings = SiteSetting::first();
        if (!$settings) {
            $settings = new SiteSetting();
        }

        $settings->company_name = $request->company_name;
        $settings->mobile = $request->mobile;
        $settings->email = $request->email;
        $settings->address = $request->address;
        $settings->copy_right_text = $request->copy_right_text;

        // Handle main logo upload
        if ($request->hasFile('company_main_logo')) {
            if ($settings->company_main_logo) {
                Storage::delete('public/' . $settings->company_main_logo);
            }
            $mainLogo = $request->file('company_main_logo');
            $mainLogoName = 'main_logo_' . time() . '.' . $mainLogo->getClientOriginalExtension();
            $mainLogo->storeAs('public/images/site', $mainLogoName);
            $settings->company_main_logo = 'images/site/' . $mainLogoName;
        }

        // Handle mini logo upload
        if ($request->hasFile('company_mini_logo')) {
            if ($settings->company_mini_logo) {
                Storage::delete('public/' . $settings->company_mini_logo);
            }
            $miniLogo = $request->file('company_mini_logo');
            $miniLogoName = 'mini_logo_' . time() . '.' . $miniLogo->getClientOriginalExtension();
            $miniLogo->storeAs('public/images/site', $miniLogoName);
            $settings->company_mini_logo = 'images/site/' . $miniLogoName;
        }

        // Handle favicon upload
        if ($request->hasFile('favicon')) {
            if ($settings->favicon) {
                Storage::delete('public/' . $settings->favicon);
            }
            $favicon = $request->file('favicon');
            $faviconName = 'favicon_' . time() . '.' . $favicon->getClientOriginalExtension();
            $favicon->storeAs('public/images/site', $faviconName);
            $settings->favicon = 'images/site/' . $faviconName;
        }

        $settings->save();

        return redirect()->back()->with('success', 'Site settings updated successfully!');
    }
}
