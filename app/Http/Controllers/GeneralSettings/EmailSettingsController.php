<?php

namespace App\Http\Controllers\GeneralSettings;

use App\Models\EmailSetting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;

class EmailSettingsController extends Controller
{
    public function index()
    {
        $settings = EmailSetting::first();
        return view('backEnd.settings.email_settings', compact('settings'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'mail_mailer' => 'required|string',
            'mail_host' => 'required|string',
            'mail_port' => 'required|numeric',
            'mail_username' => 'required|string',
            'mail_password' => 'required|string',
            'mail_encryption' => 'required|string',
            'mail_from_address' => 'required|email',
            'mail_from_name' => 'required|string',
        ]);

        $settings = EmailSetting::first();
        if (!$settings) {
            $settings = new EmailSetting();
        }

        $settings->fill($request->all());
        $settings->save();

        // Update the mail configuration at runtime
        $config = $request->all();
        foreach ($config as $key => $value) {
            Config::set('mail.' . str_replace('mail_', '', $key), $value);
        }

        return redirect()->back()->with('success', 'Email settings updated successfully.');
    }

    public function testEmail(Request $request)
    {
        $request->validate([
            'test_email' => 'required|email'
        ]);

        try {
            \Mail::to($request->test_email)->send(new \App\Mail\TestMail());
            return response()->json(['message' => 'Test email sent successfully!'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to send test email: ' . $e->getMessage()], 500);
        }
    }
}
