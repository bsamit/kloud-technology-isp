<?php

namespace App\Http\Controllers\Billing;

use App\Http\Controllers\Controller;
use App\Models\Bill;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;

class PaymentController extends Controller
{
    public function index()
    {
        $data['payments'] = Payment::with(['bill', 'user', 'approvedBy'])->latest()->get();
        return view('backEnd.billing.payments.index', $data);
    }

    public function create($billId)
    {
        $data['bill'] = Bill::with(['user', 'package'])->findOrFail($billId);
        return view('backEnd.billing.payments.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'bill_id' => 'required|exists:bills,id',
            'amount' => 'required|numeric',
            'payment_method' => 'required|in:cash,bank_transfer,mobile_banking',
            'transaction_id' => 'required_unless:payment_method,cash',
            'payment_proof' => 'required_unless:payment_method,cash|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'note' => 'nullable|string'
        ]);

        try {
            $bill = Bill::findOrFail($request->bill_id);
            
            $paymentData = $request->only([
                'bill_id',
                'amount',
                'payment_method',
                'transaction_id',
                'note'
            ]);
            
            $paymentData['user_id'] = auth()->id();

            if ($request->hasFile('payment_proof')) {
                $path = $request->file('payment_proof')->store('payment_proofs', 'public');
                $paymentData['payment_proof'] = $path;
            }

            // For cash payments, auto-approve if admin is creating
            if ($request->payment_method === 'cash' && auth()->user()->hasRole('admin')) {
                $paymentData['status'] = 'approved';
                $paymentData['approved_at'] = now();
                $paymentData['approved_by'] = auth()->id();
                $bill->update(['status' => 'paid']);
            }

            Payment::create($paymentData);

            return redirect()->route('billing.payments.index')
                ->with('success', 'Payment recorded successfully.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error recording payment: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function show($id)
    {
        $data['payment'] = Payment::with(['bill', 'user', 'approvedBy'])->findOrFail($id);
        return view('backEnd.billing.payments.show', $data);
    }

    public function reject(Request $request, $id)
    {
        try {
            $payment = Payment::findOrFail($id);
            $payment->update([
                'status' => 'rejected',
                'note' => $request->note
            ]);

            // Send rejection notification email
            Mail::send('emails.payment_rejected', [
                'payment' => $payment,
                'user' => $payment->user,
                'note' => $request->note
            ], function ($message) use ($payment) {
                $message->to($payment->user->email)
                    ->subject('Payment Rejected - Internet Service');
            });

            return redirect()->back()->with('success', 'Payment rejected successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error rejecting payment: ' . $e->getMessage());
        }
    }
}