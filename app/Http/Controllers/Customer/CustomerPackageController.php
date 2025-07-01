<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Bill;
use App\Models\Package;
use App\Models\PurchasePackage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerPackageController extends Controller
{
    public function index()
    {
        $activePackage = PurchasePackage::with(['package'])
            ->where('user_id', Auth::id())
            ->where('status', 'active')
            ->where('end_date', '>', now())
            ->first();

        $packageHistory = PurchasePackage::with(['package'])
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        $availablePackages = Package::where('status', 'active')
            ->orderBy('price')
            ->get();

        $unpaidBills = Bill::where('user_id', Auth::id())
            ->where('status', '!=', 'paid')
            ->orderBy('due_date')
            ->get();

        return view('customer.packages.index', compact(
            'activePackage',
            'packageHistory',
            'availablePackages',
            'unpaidBills'
        ));
    }

    public function show($id)
    {
        $package = PurchasePackage::with(['package', 'bills'])
            ->where('user_id', Auth::id())
            ->findOrFail($id);

        return view('customer.packages.show', compact('package'));
    }

    public function bills()
    {
        $bills = Bill::with(['package', 'payment'])
            ->where('user_id', Auth::id())
            ->orderBy('bill_date', 'desc')
            ->paginate(10);

        return view('customer.packages.bills', compact('bills'));
    }

    public function payBill($id)
    {
        $bill = Bill::where('user_id', Auth::id())
            ->findOrFail($id);

        if ($bill->status === 'paid') {
            return redirect()->route('customer.packages.bills')
                ->with('error', 'This bill has already been paid.');
        }

        return view('customer.packages.pay_bill', compact('bill'));
    }

    public function processPayment(Request $request, $id)
    {
        $request->validate([
            'payment_method' => 'required|in:bank_transfer,mobile_banking',
            'transaction_id' => 'required|string|max:255',
        ]);

        $bill = Bill::where('user_id', Auth::id())
            ->findOrFail($id);

        if ($bill->status === 'paid') {
            return redirect()->route('customer.packages.bills')
                ->with('error', 'This bill has already been paid.');
        }

        try {
            $bill->payment()->create([
                'amount' => $bill->amount,
                'payment_method' => $request->payment_method,
                'transaction_id' => $request->transaction_id,
                'payment_date' => now(),
                'status' => 'pending'
            ]);

            return redirect()->route('customer.packages.bills')
                ->with('success', 'Payment submitted successfully. It will be reviewed by admin.');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to process payment: ' . $e->getMessage());
        }
    }

    public function renewalHistory()
    {
        $renewals = PurchasePackage::with(['package'])
            ->where('user_id', Auth::id())
            ->where('end_date', '<', now())
            ->orderBy('end_date', 'desc')
            ->paginate(10);

        return view('customer.packages.renewal_history', compact('renewals'));
    }

    public function currentUsage()
    {
        $activePackage = PurchasePackage::with(['package', 'bills' => function($query) {
            $query->where('status', '!=', 'paid')
                ->orderBy('due_date');
        }])
        ->where('user_id', Auth::id())
        ->where('status', 'active')
        ->where('end_date', '>', now())
        ->first();

        if (!$activePackage) {
            return redirect()->route('customer.packages.index')
                ->with('error', 'You don\'t have any active package.');
        }

        return view('customer.packages.usage', compact('activePackage'));
    }
}
