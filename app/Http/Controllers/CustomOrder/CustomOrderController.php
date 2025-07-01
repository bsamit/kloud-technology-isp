<?php

namespace App\Http\Controllers\CustomOrder;
use App\Http\CommonList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\CustomOrder\CustomOrder;
use Spatie\Permission\Models\Permission;

class CustomOrderController extends Controller
{
    public $getAllList;

    public function __construct(CommonList $allList){
        $this->getAllList = $allList;
    }

    public function index()
    {
        $data['orders'] = CustomOrder::when(auth()->user()->role_id == 4, function ($query) {
            $query->where('user_id', auth()->user()->id);
        })
        ->get();
        return view('backEnd.customOrder.index', $data);
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'details' => 'required|string|max:500',
            ]);
            $order = new CustomOrder();
            $order->details = $request->details;
            $order->status = 'pending';
            $order->user_id = Auth::user()->id;
            $order->save();
            
            return redirect()->route('custom-order.index')->with('success', 'Order Created Successfully.');
        }catch (Exception $e) {
            return redirect()->route('custom-order.index')->with('error', 'Something Went Wrong.');
        }
    }

    public function edit(string $id)
    {
        $data['editData'] = CustomOrder::find($id);
        $data['orders'] = CustomOrder::get();
        return view('backEnd.customOrder.index', $data);
    }

    public function update(Request $request, string $id)
    {
        try {
            $validated = $request->validate([
                'details' => 'required|string|max:500',
            ]);
            $order = CustomOrder::find($id);
            $order->details = $request->details;
            $order->user_id = Auth::user()->id;
            $order->update();

            return redirect()->route('custom-order.index')->with('success', 'Order Updated Successfully.');
        }catch (Exception $e) {
            return redirect()->route('custom-order.index')->with('error', 'Something Went Wrong.');
        }
    }

    public function destroy(Request $request)
    {
        try {
            $order = CustomOrder::where('id', $request->id)->first();
            $order->delete();
            return response()->json(['success' => true, 'message' => 'Order Deleted Successfully.']);
        }catch (Exception $e) {
            return redirect()->route('custom-order.index')->with('error', 'Something Went Wrong.');
        }
    }

    public function changeStatus(Request $request)
    {
        try {
            CustomOrder::where('id', $request->id)->update(['status' => $request->status]);
            return response()->json(['success' => true, 'message' => 'Order Updated Successfully.']);
        } catch (\Throwable $th) {
            return response()->json(['error' => true, 'message' => 'Something Went Wrong.']);
        }
    }
    public function pendingCustomOrder()
    {
        $data['orders'] = CustomOrder::where('status','=','pending')->get();
        return view('backEnd.customOrder.index', $data);
    }
    public function approvedCustomOrder()
    {
        $data['orders'] = CustomOrder::where('status','=','approved')->get();
        return view('backEnd.customOrder.index', $data);
    }
    
    public function rejectedCustomOrder()
    {
        $data['orders'] = CustomOrder::where('status','=','rejected')->get();
        return view('backEnd.customOrder.index', $data);
    }

    public function approve(Request $request)
    {
        try {
            $order = CustomOrder::find($request->id);
            $order->status = 'approved';
            $order->update();

            return response()->json(['success' => true, 'message' => 'Order Approved Successfully.']);
        }catch (Exception $e) {
            return redirect()->route('custom-order.index')->with('error', 'Something Went Wrong.');
        }
    }
    public function reject(Request $request)
    {
        try {
            $order = CustomOrder::find($request->id);
            $order->status = 'rejected';
            $order->remarks = $request->remarks;
            $order->update();
            return response()->json(['success' => true, 'message' => 'Order Rejected Successfully.']);
        }catch (Exception $e) {
            return redirect()->route('custom-order.index')->with('error', 'Something Went Wrong.');
        }
    }
}

