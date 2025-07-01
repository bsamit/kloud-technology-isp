<?php

namespace App\Http\Controllers\PurchasePackage;
use App\Http\CommonList;
use Illuminate\Http\Request;
use App\Models\Package\Packages;
use App\Http\Controllers\Controller;
use App\Models\Package\PackageDetails;
use App\Models\PurchasePackage;
use Spatie\Permission\Models\Permission;
use App\Models\Bill;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class PurchasePackageController extends Controller
{
    public $getAllList;

    public function __construct(CommonList $allList){
        $this->getAllList = $allList;
    }

    public function inactiveIndex()
    {
        return view('backEnd.purchasePackage.inactive_package');
    }
    public function activeIndex()
    {
        return view('backEnd.purchasePackage.active_package');
    }
    public function addPackageToUserIndex()
    {
        $data['users'] = $this->getAllList->getAllActiveCustomerList();
        $data['packages'] = $this->getAllList->getAllActivePackageList();
        return view('backEnd.purchasePackage.add_package_to_user', $data);
    }

    public function expiredIndex()
    {
        $expiredPackages = PurchasePackage::with(['user', 'package'])
            ->where('end_date', '<', now())
            ->orderBy('end_date', 'desc')
            ->paginate(10);

        return view('backEnd.purchasePackage.expired_package', compact('expiredPackages'));
    }

    public function addPackageToUserStore(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,uuid',
            'package_id' => 'required|exists:packages,uuid',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'last_payment_date' => 'required|date',
            'monthly_fee' => 'required|numeric|min:0',
            'setup_fee' => 'nullable',
            'status' => 'required|in:active,inactive'
        ]);

        try {
            DB::beginTransaction();

            // Get the user and package using UUID
            $user = User::where('uuid', $request->user_id)->firstOrFail();
            $package = Packages::where('uuid', $request->package_id)->firstOrFail();

            // Create purchase package record
            $purchasePackage = PurchasePackage::create([
                'user_id' => $user->id,
                'package_id' => $package->id,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'last_payment_date' => $request->last_payment_date,
                'monthly_fee' => $request->monthly_fee,
                'setup_fee' => $request->setup_fee ?? 0,
                'status' => $request->status
            ]);

            // Generate bills
            // 1. Setup fee bill if applicable
            if ($request->setup_fee > 0) {
                Bill::create([
                    'user_id' => $user->id,
                    'package_id' => $package->id,
                    'purchase_package_id' => $purchasePackage->id,
                    'amount' => $request->setup_fee,
                    'bill_date' => now(),
                    'due_date' => now()->addDays(7),
                    'status' => 'pending',
                    'bill_type' => 'setup_fee'
                ]);
            }

            // 2. Monthly fee bill
            Bill::create([
                'user_id' => $user->id,
                'package_id' => $package->id,
                'purchase_package_id' => $purchasePackage->id,
                'amount' => $request->monthly_fee,
                'bill_date' => now(),
                'due_date' => now()->addDays(7),
                'status' => 'pending',
                'bill_type' => 'monthly_fee'
            ]);

            DB::commit();
            return redirect()->route('purchase-package.active')
                ->with('success', 'Package assigned to user successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Failed to assign package: ' . $e->getMessage())->withInput();
        }
    }
}
