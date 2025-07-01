<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
            'company_main_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'company_mini_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'copy_right_text' => 'required|string|max:255',
        ]);

        try {
            $settings = SiteSetting::first();
            if (!$settings) {
                $settings = new SiteSetting();
            }

            $settings->company_name = $request->company_name;
            $settings->copy_right_text = $request->copy_right_text;

            // Handle main logo upload
            if ($request->hasFile('company_main_logo')) {
                // Delete old logo if exists
                if ($settings->company_main_logo && Storage::exists($settings->company_main_logo)) {
                    Storage::delete($settings->company_main_logo);
                }
                $mainLogo = $request->file('company_main_logo');
                $mainLogoPath = $mainLogo->store('images/site');
                $settings->company_main_logo = $mainLogoPath;
            }

            // Handle mini logo upload
            if ($request->hasFile('company_mini_logo')) {
                // Delete old logo if exists
                if ($settings->company_mini_logo && Storage::exists($settings->company_mini_logo)) {
                    Storage::delete($settings->company_mini_logo);
                }
                $miniLogo = $request->file('company_mini_logo');
                $miniLogoPath = $miniLogo->store('images/site');
                $settings->company_mini_logo = $miniLogoPath;
            }

            $settings->save();

            return redirect()->route('general-settings.site-settings.index')
                ->with('success', 'Site settings updated successfully');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to update site settings: ' . $e->getMessage());
        }
    }
}
