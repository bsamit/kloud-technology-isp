<?php

namespace App\Http\Controllers\Helpdesk;

use App\Http\CommonList;
use Illuminate\Http\Request;
use App\Models\Helpdesk\Ticket;
use App\Models\Package\Packages;
use App\Http\Controllers\Controller;
use App\Models\Helpdesk\TicketReply;
use Illuminate\Support\Facades\Auth;
use App\Models\Helpdesk\HelpdeskCategory;

class TicketReplyController extends Controller
{
    public function reply(Request $request, $id)
    {
        try {
            // dd($request);
            $validated = $request->validate([
                'details' => 'required|string|max:500',
            ]);
            $reply = new TicketReply();
            $reply->details = $request->details;
            $reply->ticket_id = $id;
            $reply->status = $request->status ?? 'pending';
            $reply->attachment = $request->attachment;
            $reply->sender_id = Auth::user()->id;
            $reply->save();

            if($request->status){
                $ticket = Ticket::find($id);
                $ticket->status = $request->status;
                $ticket->update();
            }
            
            return redirect()->back()->with('success', 'Reply Created Successfully.');
        }catch (Exception $e) {
            return redirect()->route('helpdesk.tickets.index')->with('error', 'Something Went Wrong.');
        }
    }
}

