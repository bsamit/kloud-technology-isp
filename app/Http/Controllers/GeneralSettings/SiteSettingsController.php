<?php

namespace App\Http\Controllers\GeneralSettings;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\GeneralSettings\SiteSetting;
use Illuminate\Support\Facades\File;

class SiteSettingsController extends Controller
{
    public function index()
    {
        $settings = SiteSetting::first();
        return view('backEnd.settings.site_settings', compact('settings'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'company_name' => 'required|string|max:255',
            'copy_right_text' => 'required|string|max:255',
            'company_main_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'company_mini_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'favicon' => 'nullable|file|mimes:ico,png|max:1024',
        ]);

        $settings = SiteSetting::first();

        $settings->company_name = $request->company_name;
        $settings->mobile = $request->mobile;
        $settings->email = $request->email;
        $settings->address = $request->address;
        $settings->copy_right_text = $request->copy_right_text;

        // Handle main logo upload
        if ($request->hasFile('company_main_logo')) {
            // Delete old logo if exists
            if ($settings->company_main_logo && File::exists(public_path($settings->company_main_logo))) {
                File::delete(public_path($settings->company_main_logo));
            }

            $mainLogo = $request->file('company_main_logo');
            $mainLogoName = time() . '_main.' . $mainLogo->getClientOriginalExtension();
            $mainLogo->move(public_path('images/site'), $mainLogoName);
            $settings->company_main_logo = 'images/site/' . $mainLogoName;
        }

        // Handle mini logo upload
        if ($request->hasFile('company_mini_logo')) {
            // Delete old logo if exists
            if ($settings->company_mini_logo && File::exists(public_path($settings->company_mini_logo))) {
                File::delete(public_path($settings->company_mini_logo));
            }

            $miniLogo = $request->file('company_mini_logo');
            $miniLogoName = time() . '_mini.' . $miniLogo->getClientOriginalExtension();
            $miniLogo->move(public_path('images/site'), $miniLogoName);
            $settings->company_mini_logo = 'images/site/' . $miniLogoName;
        }

        // Handle favicon upload
        if ($request->hasFile('favicon')) {
            // Delete old favicon if exists
            if ($settings->favicon && File::exists(public_path($settings->favicon))) {
                File::delete(public_path($settings->favicon));
            }

            $favicon = $request->file('favicon');
            $faviconName = 'favicon.' . $favicon->getClientOriginalExtension();
            $favicon->move(public_path(), $faviconName);
            $settings->favicon = $faviconName;
        }

        $settings->save();

        return redirect()->back()->with('success', 'Site settings updated successfully.');
    }
}
