<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MessageController extends Controller
{
    public function index()
    {
        $staffMembers = User::where('role_id', 2)->get();
        $customers = User::where('role_id', 4)->get();
        
        return view('backEnd.messaging.index', compact('staffMembers', 'customers'));
    }

    public function sendMessage(Request $request)
    {
        $request->validate([
            'staff_recipients.*' => 'nullable|string',
            'customer_recipients.*' => 'nullable|string',
            'message_type' => 'required|in:email,sms',
            'message' => 'required|string'
        ]);

        $recipients = [];
        
        // Merge staff and customer recipients
        if ($request->has('staff_recipients')) {
            $recipients = array_merge($recipients, $request->staff_recipients);
        }
        if ($request->has('customer_recipients')) {
            $recipients = array_merge($recipients, $request->customer_recipients);
        }

        if (empty($recipients)) {
            return redirect()->back()->with('error', 'Please select at least one recipient!');
        }

        $messageType = $request->message_type;
        $message = $request->message;

        foreach ($recipients as $recipient) {
            if ($recipient === 'all') continue; // Skip the "Select All" option
            
            list($type, $id) = explode('_', $recipient);
            $user = User::find($id);

            if (!$user) continue;

            if ($messageType === 'email') {
                // Send email
                try {
                    Mail::raw($message, function($mail) use ($user) {
                        $mail->to($user->email)
                             ->subject('New Message from ISP Management');
                    });
                } catch (\Exception $e) {
                    // Log error
                }
            } else {
                // SMS implementation
                // Add your SMS service integration here
                // Example: Twilio, Nexmo, etc.
            }
        }

        return redirect()->back()->with('success', 'Messages sent successfully!');
    }
}
