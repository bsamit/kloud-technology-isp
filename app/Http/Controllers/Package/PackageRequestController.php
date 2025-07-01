<?php

namespace App\Http\Controllers\Package;

use App\Http\Controllers\Controller;
use App\Models\PackageRequest;
use App\Models\PurchasePackage;
use App\Models\Bill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PackageRequestController extends Controller
{
    public function index()
    {
        $requests = PackageRequest::with(['user', 'package', 'approvedBy'])->latest()->get();
        return view('backEnd.packages.admin.requests', compact('requests'));
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
                $packageRequest = new PackageRequest();
                $packageRequest->user_id = auth()->id();
                $packageRequest->package_id = $request->package_id;
                $packageRequest->note = $request->note;
                $packageRequest->status = 'pending';
                $packageRequest->save();
            DB::commit();
            return redirect()->back()->with('success', 'Package request submitted successfully. Please wait for admin approval.');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    public function approve(Request $request, $id)
    {
        try {
            $validator = \Validator::make($request->all(), [
                'start_date' => 'required|date',
                'end_date' => 'required|date|after:start_date',
                'last_payment_date' => [
                    'required',
                    'date',
                    'after_or_equal:start_date',
                    'after_or_equal:end_date'
                ]
            ], [
                'last_payment_date.after_or_equal' => 'Last payment date cannot be earlier than start date or end date'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'message' => $validator->errors()->first()
                ], 422);
            }

            DB::beginTransaction();

            $packageRequest = PackageRequest::with('package')->findOrFail($id);
            
            if ($packageRequest->status !== 'pending') {
                return response()->json([
                    'status' => 'error',
                    'message' => 'This request has already been processed.'
                ], 422);
            }

            $purchasePackage = new PurchasePackage();
            $purchasePackage->user_id = $packageRequest->user_id;
            $purchasePackage->package_id = $packageRequest->package_id;
            $purchasePackage->status = 1;
            $purchasePackage->start_date = storeDateFormat($request->start_date);
            $purchasePackage->end_date = storeDateFormat($request->end_date);
            $purchasePackage->amount = $packageRequest->package->monthly_cost;
            $purchasePackage->last_payment_date = storeDateFormat($request->last_payment_date);
            $purchasePackage->setup_fee = $packageRequest->package->setup_fee ?? 0;
            $purchasePackage->save();

            // Create bill
            $bill = new Bill();
            $bill->user_id = $packageRequest->user_id;
            $bill->package_id = $packageRequest->package_id;
            $bill->purchase_package_id = $purchasePackage->id;
            $bill->amount = $packageRequest->package->monthly_cost + ($packageRequest->package->setup_fee ?? 0);
            $bill->due_date = storeDateFormat($request->end_date);
            $bill->last_payment_date = storeDateFormat($request->last_payment_date);
            $bill->status = 'payment_pending';
            $bill->save();

            // Update package request
            $packageRequest->status = 'approved';
            $packageRequest->approved_by = auth()->id();
            $packageRequest->approved_at = now();
            $packageRequest->save();

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Package request approved successfully. Bill has been generated.'
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Package approval error: ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong. Please try again.'
            ], 500);
        }
    }

    public function reject(Request $request, $id)
    {
        $request->validate([
            'rejection_reason' => 'required|string|max:500'
        ]);

        $packageRequest = PackageRequest::findOrFail($id);
        
        if ($packageRequest->status !== 'pending') {
            return back()->with('error', 'This request has already been processed.');
        }

        $packageRequest->status = 'rejected';
        $packageRequest->rejected_at = now();
        $packageRequest->rejection_reason = $request->rejection_reason;
        $packageRequest->save();

        return back()->with('success', 'Package request rejected successfully.');
    }

    public function myRequests()
    {
        $requests = PackageRequest::with(['package', 'approvedBy'])
            ->where('user_id', auth()->id())
            ->latest()
            ->get();
            
        return view('backEnd.packages.user.my_requests', compact('requests'));
    }
}
