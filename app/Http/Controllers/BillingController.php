<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\PackageRequest;
use App\Models\User;
use App\Models\Payment;
use App\Models\PurchasePackage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class BillingController extends Controller
{

    public function index()
    {
        $user = auth()->user();
        
        // Get current package
        $currentPackage = PurchasePackage::with('package')
            ->where('user_id', $user->id)
            ->where('status', 'active')
            ->latest()
            ->first();

        // Get billing history
        $billingHistory = Bill::with(['package', 'payment'])
            ->where('user_id', $user->id)
            ->latest()
            ->get();

        // Get payments list
        $payments = Payment::with('user')
            ->latest()
            ->paginate(10);

        return view('backEnd.billing.payments.index', compact('payments', 'currentPackage', 'billingHistory'));
    }

    public function show(Bill $bill)
    {
        return view('backEnd.billing.show', compact('bill'));
    }

    public function approve(Request $request, Bill $bill)
    {
        // Validate request
        $request->validate([
            'payment_method' => 'required|in:cash',
            'note' => 'nullable|string|max:500'
        ]);

        // Check if bill is already paid
        if ($bill->status === Bill::STATUS_PAID) {
            return response()->json([
                'status' => 'error',
                'message' => 'This bill has already been paid.'
            ], 422);
        }

        try {
            DB::beginTransaction();

            // Create new payment
            $payment = new Payment();
            $payment->bill_id = $bill->id;
            $payment->user_id = $bill->user_id;
            $payment->amount = $bill->amount;
            $payment->payment_method = $request->payment_method;
            $payment->payment_date = now();
            $payment->note = $request->note;
            $payment->status = Payment::STATUS_APPROVED;
            $payment->approved_by = auth()->id();
            $payment->approved_at = now();
            $payment->save();

            // Update bill status
            $bill->status = Bill::STATUS_PAID;
            $bill->last_payment_date = now();
            $bill->save();

            $requestPackage = PackageRequest::where('id', $bill->purchase_package_id)->first();
            $requestPackage->update(['payment_status' => 'paid']);

            // Update purchase package last payment date if exists
            // if ($bill->purchase_package_id) {
            //     $purchasePackage = PurchasePackage::find($bill->purchase_package_id);
            //     if ($purchasePackage) {
            //         $purchasePackage->last_payment_date = now();
            //         $purchasePackage->save();
            //     }
            // }

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Payment approved successfully.'
            ]);

        } catch (\Exception $e) {
            DB::rollback();
            dd($e);
            \Log::error('Payment approval error: ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong. Please try again.'
            ], 500);
        }
    }

    public function reject(Request $request, Bill $bill)
    {
        // Validate request
        $request->validate([
            'rejection_note' => 'required|string|max:500'
        ]);

        // Check if bill is already paid
        if ($bill->status === Bill::STATUS_PAID) {
            return response()->json([
                'status' => 'error',
                'message' => 'Cannot reject a paid bill.'
            ], 422);
        }

        try {
            DB::beginTransaction();

            // Create rejection record
            $rejection = new PaymentRejection();
            $rejection->bill_id = $bill->id;
            $rejection->rejected_by = auth()->id();
            $rejection->rejection_note = $request->rejection_note;
            $rejection->rejected_at = now();
            $rejection->save();

            // Update bill status
            $bill->status = Bill::STATUS_REJECTED;
            $bill->save();

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Payment rejected successfully.'
            ]);

        } catch (\Exception $e) {
            DB::rollback();
            \Log::error('Payment rejection error: ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong. Please try again.'
            ], 500);
        }
    }

    public function generate()
    {
        try {
            DB::beginTransaction();

            // Get all active purchase packages that need billing
            $packages = PurchasePackage::where('status', true)
                ->where(function($query) {
                    $query->whereNull('last_payment_date')
                        ->orWhere('last_payment_date', '<=', now()->subMonth());
                })
                ->get();

            if ($packages->isEmpty()) {
                return back()->with('info', 'No packages found that need billing.');
            }

            $count = 0;
            foreach ($packages as $package) {
                // Check if a bill already exists for this month
                $existingBill = Bill::where('purchase_package_id', $package->id)
                    ->where('bill_type', Bill::BILL_TYPE_MONTHLY)
                    ->whereMonth('bill_date', now()->month)
                    ->whereYear('bill_date', now()->year)
                    ->first();

                if (!$existingBill) {
                    // Create new bill
                    $bill = new Bill();
                    $bill->user_id = $package->user_id;
                    $bill->package_id = $package->package_id;
                    $bill->purchase_package_id = $package->id;
                    $bill->amount = $package->monthly_fee;
                    $bill->bill_type = Bill::BILL_TYPE_MONTHLY;
                    $bill->bill_date = now();
                    $bill->due_date = now()->addDays(7);
                    $bill->status = Bill::STATUS_PENDING;
                    $bill->save();
                    $count++;
                }
            }

            DB::commit();

            if ($count > 0) {
                return back()->with('success', "Generated $count new bills successfully.");
            } else {
                return back()->with('info', 'No new bills were generated. All packages are already billed for this month.');
            }
        } catch (\Exception $e) {
            DB::rollback();
            \Log::error('Bill generation error: ' . $e->getMessage());
            return back()->with('error', 'Something went wrong while generating bills: ' . $e->getMessage());
        }
    }

    public function userBills(User $user)
    {
        $bills = Bill::with(['package', 'payment'])
            ->where('user_id', $user->id)
            ->latest()
            ->paginate(10);

        return view('backEnd.billing.customer_bills', compact('bills', 'user'));
    }

    // Customer Methods
    public function myBills()
    {
        $bills = Bill::with(['package', 'payment'])
            ->where('user_id', auth()->id())
            ->latest()
            ->paginate(10);

        return view('backEnd.billing.customer_bills', compact('bills'));
    }

    public function customerShow(Bill $bill)
    {
        // Check if bill belongs to user
        if ($bill->user_id !== auth()->id()) {
            abort(403);
        }

        return view('backEnd.billing.customer_show', compact('bill'));
    }

    public function customerPay(Request $request, Bill $bill)
    {
        // Validate request
        $request->validate([
            'payment_method' => 'required|in:'. implode(',', Payment::PAYMENT_METHODS),
            'transaction_id' => 'required|string|max:255',
            'payment_proof' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048'
        ]);

        // Check if bill belongs to user
        if ($bill->user_id !== auth()->id()) {
            abort(403);
        }

        // Check if bill is in correct status
        if ($bill->status !== Bill::STATUS_PENDING) {
            return back()->with('error', 'This bill cannot be paid at this time.');
        }

        try {
            DB::beginTransaction();

            // Handle file upload if provided
            $paymentProofPath = null;
            if ($request->hasFile('payment_proof')) {
                $file = $request->file('payment_proof');
                $filename = time() . '_' . $file->getClientOriginalName();
                $paymentProofPath = $file->storeAs('payment_proofs', $filename, 'public');
            }

            // Create payment record
            $payment = new Payment();
            $payment->bill_id = $bill->id;
            $payment->user_id = auth()->id();
            $payment->amount = $bill->amount;
            $payment->payment_method = $request->payment_method;
            $payment->transaction_id = $request->transaction_id;
            $payment->payment_proof = $paymentProofPath;
            $payment->status = 'pending';
            $payment->save();

            // Update bill status to payment pending
            $bill->status = Bill::STATUS_PAYMENT_PENDING;
            $bill->save();

            DB::commit();

            return back()->with('success', 'Payment submitted successfully. Please wait for admin approval.');
        } catch (\Exception $e) {
            DB::rollback();
            \Log::error('Payment submission error: ' . $e->getMessage());
            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }
}
