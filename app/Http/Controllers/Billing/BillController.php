<?php

namespace App\Http\Controllers\Billing;

use App\Http\Controllers\Controller;
use App\Models\Bill;
use App\Models\Payment;
use App\Models\PurchasePackage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BillController extends Controller
{
    public function index()
    {
        $bills = Bill::with(['user', 'package', 'purchasePackage'])
            ->orderBy('bill_date', 'desc')
            ->paginate(10);

        return view('backEnd.billing.index', compact('bills'));
    }

    public function customerBills($customerId)
    {
        $bills = Bill::with(['package', 'purchasePackage'])
            ->where('user_id', $customerId)
            ->orderBy('bill_date', 'desc')
            ->paginate(10);

        return view('backEnd.billing.customer_bills', compact('bills'));
    }

    public function show($id)
    {
        $bill = Bill::with(['user', 'package', 'purchasePackage', 'payment'])
            ->findOrFail($id);

        return view('backEnd.billing.show', compact('bill'));
    }

    public function generateBills()
    {
        try {
            DB::beginTransaction();

            $currentMonth = now();
            $nextMonth = now()->addMonth();
            $activePackages = PurchasePackage::with(['package'])
                ->where('status', 'active')
                ->where('end_date', '>', $currentMonth)
                ->get();

            $generatedCount = 0;
            foreach ($activePackages as $package) {
                // First check if current month's bill exists
                $currentMonthBill = Bill::where('user_id', $package->user_id)
                    ->where('package_id', $package->package_id)
                    ->whereMonth('billing_month', $currentMonth->month)
                    ->whereYear('billing_month', $currentMonth->year)
                    ->first();

                // Only proceed if current month's bill exists
                if ($currentMonthBill) {
                    // Check if next month's bill already exists
                    $nextMonthBill = Bill::where('user_id', $package->user_id)
                        ->where('package_id', $package->package_id)
                        ->whereMonth('billing_month', $nextMonth->month)
                        ->whereYear('billing_month', $nextMonth->year)
                        ->first();

                    if (!$nextMonthBill) {
                        // Create next month's bill
                        Bill::create([
                            'user_id' => $package->user_id,
                            'package_id' => $package->package_id,
                            'purchase_package_id' => $package->id,
                            'amount' => $package->package->price,
                            'bill_date' => now(),
                            'billing_month' => $nextMonth->startOfMonth(),
                            'due_date' => $nextMonth->copy()->startOfMonth()->addDays(7),
                            'status' => 'pending',
                            'bill_type' => Bill::BILL_TYPE_MONTHLY
                        ]);

                        // Update package end_date and last_payment_date
                        $package->update([
                            'end_date' => $nextMonth->copy()->endOfMonth(),
                            'last_payment_date' => $currentMonth->copy()->endOfMonth()
                        ]);

                        $generatedCount++;
                    }
                }
            }

            DB::commit();
            
            if ($generatedCount > 0) {
                return redirect()->route('admin.billing.index')
                    ->with('success', "Generated {$generatedCount} bills for next month successfully");
            } else {
                return redirect()->route('admin.billing.index')
                    ->with('info', 'No bills were generated. Either current month bills are missing or next month bills already exist.');
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Failed to generate bills: ' . $e->getMessage());
        }
    }

    public function approvePayment(Request $request, $id)
    {
        $bill = Bill::findOrFail($id);

        if ($bill->status === 'paid') {
            return back()->with('error', 'Bill is already paid');
        }

        try {
            DB::beginTransaction();

            // Update bill status
            $bill->update(['status' => 'paid']);

            // Create payment record
            Payment::create([
                'bill_id' => $bill->id,
                'user_id' => $bill->user_id,
                'amount' => $bill->amount,
                'payment_date' => now(),
                'payment_method' => $request->payment_method,
                'transaction_id' => $request->transaction_id,
                'status' => 'approved'
            ]);

            DB::commit();
            return redirect()->route('admin.billing.show', $id)
                ->with('success', 'Payment approved successfully');
        } catch (\Exception $e) {
            dd($e);
            DB::rollBack();
            return back()->with('error', 'Failed to approve payment: ' . $e->getMessage());
        }
    }
}