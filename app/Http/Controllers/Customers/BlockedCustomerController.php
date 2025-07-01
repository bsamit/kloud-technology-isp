<?php

namespace App\Http\Controllers\Customers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class BlockedCustomerController extends Controller
{
    public function index()
    {
        $blockedCustomers = User::where('status', 2)->latest()->get();
        return view('backEnd.customers.blocked-customer.index', compact('blockedCustomers'));
    }

    public function unblock($id)
    {
        try {
            $customer = User::findOrFail($id);
            $customer->update([
                'status' => 1
            ]);
            return redirect()->back()->with('success', 'Customer unblocked successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }
}
