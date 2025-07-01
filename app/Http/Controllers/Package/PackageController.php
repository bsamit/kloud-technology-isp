<?php

namespace App\Http\Controllers\Package;

use App\Http\CommonList;
use Illuminate\Http\Request;
use App\Models\Package\Packages;
use App\Http\Controllers\Controller;
use App\Models\Package\PackageDetails;
use App\Models\PurchasePackage;
use App\Models\Bill;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PackageController extends Controller
{
    public $getAllList;
    public $listRoute = 'manage-package.package.index';

    public function __construct(CommonList $allList){
        $this->getAllList = $allList;
    }

    public function index()
    {
        $data['package_category'] = $this->getAllList->getPackageCategoryList();
        $data['package_lists'] = Packages::with('packageCategory', 'packageDetails')->get();
        return view('backEnd.managePackage.index', $data);
    }

    public function confirmPackage($id)
    {
        $package = Packages::with('packageDetails')->findOrFail($id);
        return view('backEnd.packages.confirm', compact('package'));
    }

    public function purchasePackage(Request $request, $id)
    {
        $request->validate([
            'payment_method' => 'required|in:cash,bank,mobile_banking',
            'payment_proof' => 'required_if:payment_method,bank,mobile_banking|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'note' => 'nullable|string|max:500'
        ]);

        $package = Packages::findOrFail($id);

        try {
            DB::beginTransaction();

            // Create Purchase Package
            $purchasePackage = new PurchasePackage();
            $purchasePackage->user_id = auth()->id();
            $purchasePackage->package_id = $package->id;
            $purchasePackage->start_date = now();
            $purchasePackage->end_date = now()->addMonth();
            $purchasePackage->monthly_fee = $package->monthly_cost;
            $purchasePackage->setup_fee = $package->setup_fee ?? 0;
            $purchasePackage->status = 'pending';
            $purchasePackage->save();

            // Create Bill
            $bill = new Bill();
            $bill->user_id = auth()->id();
            $bill->package_id = $package->id;
            $bill->purchase_package_id = $purchasePackage->id;
            $bill->amount = $package->monthly_cost + ($package->setup_fee ?? 0);
            $bill->bill_date = now();
            $bill->due_date = now()->addDays(7);
            $bill->status = 'pending';
            $bill->note = $request->note;
            $bill->save();

            // Create Payment
            $payment = new Payment();
            $payment->bill_id = $bill->id;
            $payment->user_id = auth()->id();
            $payment->amount = $bill->amount;
            $payment->payment_method = $request->payment_method;
            $payment->status = 'pending';
            
            if ($request->hasFile('payment_proof')) {
                $file = $request->file('payment_proof');
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('uploads/payment_proofs'), $filename);
                $payment->payment_proof = 'uploads/payment_proofs/' . $filename;
            }
            
            $payment->note = $request->note;
            $payment->save();

            DB::commit();

            return redirect()->route('customer.bills')->with('success', 'Package purchased successfully! Please wait for payment confirmation.');

        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Something went wrong! Please try again.');
        }
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            // 'package_category_id' => 'required',
            'plan_name' => 'required',
            'title' => 'required',
            'speed' => 'required',
            'monthly_cost' => 'required',
        ]);
        try {
            $package = new Packages();
            $package->package_catgory_id = $request->package_category_id ?? 1;
            $package->plan_name = $request->plan_name;
            $package->title = $request->title;
            $package->speed = $request->speed;
            $package->monthly_cost = $request->monthly_cost;
            $package->save();
            
            foreach (gv($request, 'attributes') as $key => $value) {
                $packageDetails = new PackageDetails();
                $packageDetails->package_id = $package->id;
                $packageDetails->name = gv($value, 'name');
                $packageDetails->value = gv($value, 'value');
                $packageDetails->save();
            }
            return redirect()->route($this->listRoute)->with('success', 'Package Created Successfully.');
        }catch (\Throwable $th) {
            dd($th);
        }
    }

    public function edit(string $id)
    {
        $data['package_category'] = $this->getAllList->getPackageCategoryList();
        $data['package_lists'] = Packages::with('packageCategory', 'packageDetails')->get();
        $data['editData'] = Packages::with('packageDetails')->where('uuid', $id)->first();
        return view('backEnd.managePackage.index', $data);
    }

    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            // 'package_category_id' => 'required',
            'plan_name' => 'required',
            'title' => 'required',
            'speed' => 'required',
            'monthly_cost' => 'required',
        ]);
        try {
            $package = Packages::where('uuid', $id)->first();
            $package->package_catgory_id = $request->package_category_id ?? 1;
            $package->plan_name = $package->plan_name;
            $package->title = $package->title;
            $package->speed = $request->speed;
            $package->monthly_cost = $request->monthly_cost;
            $package->update();

            PackageDetails::where('package_id', $package->id)->delete();
            
            foreach (gv($request, 'attributes') as $key => $value) {
                $packageDetails = new PackageDetails();
                $packageDetails->package_id = $package->id;
                $packageDetails->name = gv($value, 'name');
                $packageDetails->value = gv($value, 'value');
                $packageDetails->save();
            }
            return redirect()->route($this->listRoute)->with('success', 'Package Updated Successfully.');
        }catch (\Throwable $th) {
            dd($th);
        }
    }

    public function destroy(Request $request)
    {
        try {
            $package = Packages::where('uuid', $request->id)->first();
            $package->delete();
            return response()->json(['success' => true, 'message' => 'Package Deleted Successfully.']);
        } catch (\Throwable $th) {
            return response()->json(['error' => true, 'message' => 'Something Went Wrong.']);
        }
    }

    public function changeStatus(Request $request)
    {
        try {
            Packages::where('uuid', $request->id)->update(['status' => $request->status]);
            return response()->json(['success' => true, 'message' => 'Package Updated Successfully.']);
        } catch (\Throwable $th) {
            return response()->json(['error' => true, 'message' => 'Something Went Wrong.']);
        }
    }

    public function packageDetails($id)
    {
        try {
            if(auth()->user()->role_id == 4){
                $data['package'] = Packages::with('packageCategory', 'packageDetails')
                                    ->where('status', 1)
                                    ->where('uuid', $id)
                                    ->first();
                return view('backEnd.managePackage.package_details', $data);
            }else{
                return redirect()->route($this->listRoute)->with('warning', 'You are not authorized to access this page.');
            }
        } catch (\Throwable $th) {
            dd($th);
            return response()->json(['error' => true, 'message' => 'Something Went Wrong.']);
        }
    }

    public function customerPackages()
    {
        $packages = Packages::with(['packageDetails', 'packageCategory'])
            ->where('status', 1)
            ->latest()
            ->get()
            ->map(function($package) {
                // Check if user has already requested this package
                $hasRequested = $package->packageRequests()
                    ->where('user_id', auth()->id())
                    ->where('status', 'pending')
                    ->exists();
                
                // Check if user already has this package
                $hasPackage = $package->purchasePackages()
                    ->where('user_id', auth()->id())
                    ->where('status', 'active')
                    ->exists();
                
                $package->can_request = !$hasRequested && !$hasPackage;
                return $package;
            });

        return view('backEnd.packages.customer.available-packages', compact('packages'));
    }

    public function myPackages()
    {
        $activePackages = PurchasePackage::with(['package', 'bills'])
            ->where('user_id', auth()->id())
            ->where('status', 'active')
            ->get()
            ->map(function($package) {
                $latestBill = $package->bills()->latest()->first();
                $package->can_request_new = false;
                
                if ($latestBill && $latestBill->status === 'paid' && $package->end_date && $package->end_date < now()) {
                    $package->can_request_new = true;
                }
                
                return $package;
            });
            
        $expiredPackages = PurchasePackage::with(['package'])
            ->where('user_id', auth()->id())
            ->where('status', 'expired')
            ->latest()
            ->get();

        $packages = PurchasePackage::where('user_id', auth()->user()->id)
                    ->with('package')
                    ->latest()
                    ->get();
            
        return view('backEnd.packages.customer.my-packages', compact('activePackages', 'expiredPackages', 'packages'));
    }

    public function customerPackageDetails($uuid)
    {
        $package = PurchasePackage::with(['package.packageDetails', 'package.packageCategory', 'bills'])
            ->where('uuid', $uuid)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        return view('backEnd.packages.customer.package-details', compact('package'));
    }
}