<?php

namespace App\Http\Controllers\Helpdesk;

use App\Http\CommonList;
use Illuminate\Http\Request;
use App\Models\Helpdesk\Ticket;
use App\Models\Package\Packages;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Helpdesk\HelpdeskCategory;

class TicketController extends Controller
{
    public $getAllList;

    public function __construct(CommonList $allList){
        $this->getAllList = $allList;
    }

    public function index()
    {
        $data['tickets'] = Ticket::with('ticket_category', 'package')->get();
        $data['status'] = 'All';
        return view('backEnd.helpdesk.ticket.index', $data);
    }

    public function create()
    {
        $data['categories']  = $this->getAllList->getHelpdeskCategoryList();
        $data['packages']  = $this->getAllList->getPackageList();
        return view('backEnd.helpdesk.ticket.form', $data);
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'subject' => 'required|string|max:50',
                'details' => 'required|string|max:50',
            ]);
            $ticket = new Ticket();
            $ticket->subject = $request->subject;
            $ticket->details = $request->details;
            $ticket->package_id = $request->package_id;
            $ticket->ticket_category_id = $request->ticket_category_id;
            $ticket->user_id = Auth::user()->id;
            $ticket->save();
            
            return redirect()->route('helpdesk.tickets.index')->with('success', 'Ticket Created Successfully.');
        }catch (Exception $e) {
            return redirect()->route('helpdesk.tickets.index')->with('error', 'Something Went Wrong.');
        }
    }

    public function edit(string $id)
    {
        $data['editData'] = Ticket::find($id);
        $data['categories']  = $this->getAllList->getHelpdeskCategoryList();
        $data['packages']  = $this->getAllList->getPackageList();
        return view('backEnd.helpdesk.ticket.form', $data);
    }

    public function update(Request $request, string $id)
    {
        try {
            $validated = $request->validate([
                'subject' => 'required|string|max:50',
                'details' => 'required|string|max:50',
            ]);
            $ticket = Ticket::find($id);
            $ticket->subject = $request->subject;
            $ticket->details = $request->details;
            $ticket->package_id = $request->package_id;
            $ticket->ticket_category_id = $request->ticket_category_id;
            $ticket->user_id = Auth::user()->id;
            $ticket->update();

            return redirect()->route('helpdesk.tickets.index')->with('success', 'Ticket Updated Successfully.');
        }catch (Exception $e) {
            return redirect()->route('helpdesk.tickets.index')->with('error', 'Something Went Wrong.');
        }
    }

    public function destroy(Request $request)
    {
        try {
            $ticket = Ticket::where('id', $request->id)->first();
            $ticket->delete();
            return response()->json(['success' => true, 'message' => 'Ticket Deleted Successfully.']);
        } catch (\Throwable $th) {
            return response()->json(['error' => true, 'message' => 'Something Went Wrong.']);
        }
    }
    public function details($id, $tab)
    {
        $data['ticket'] = Ticket::with('ticket_replies', 'ticket_category', 'ticket_replies.user')->find($id);
        return view('backEnd.helpdesk.ticket.details', $data);
    }

    public function pendingTicket()
    {
        $data['tickets'] = Ticket::where('status', '=', 'pending')->get();
        $data['status'] = 'Pending';
        return view('backEnd.helpdesk.ticket.index', $data);
    }
    public function closedTicket()
    {
        $data['tickets'] = Ticket::where('status', '=', 'closed')->get();
        $data['status'] = 'Closed';
        return view('backEnd.helpdesk.ticket.index', $data);
    }
    public function answeredTicket()
    {
        $data['tickets'] = Ticket::where('status', '=', 'answered')->get();
        $data['status'] = 'Answered';
        return view('backEnd.helpdesk.ticket.index', $data);
    }
}

