<?php

namespace App\Http\Controllers\Customers;

use App\Models\User;
use App\Http\CommonList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\CustomerRequest;

class ManageCustomerController extends Controller
{
    public $getAllList;

    public function __construct(CommonList $allList){
        $this->getAllList = $allList;
    }

    public function index()
    {
        $data['customers'] = User::where('role_id', 4)->where('status', 1)->get();
        return view('backEnd.customers.manage-customer.index', $data);
    }

    public function create()
    {
        return view('backEnd.customers.manage-customer.form');
    }

    public function store(CustomerRequest $request)
    {
        try {
            User::create($this->formatCustomerData($request->all()));
            return redirect()->route('customers.manage-customer.index')->with('success', 'Customer Created Successfully.');
        }catch (\Throwable $th) {
            return redirect()->route('customers.manage-customer.index')->with('error', 'Something Went Wrong.');
        }
    }

    public function edit(string $id)
    {
        $data['editData'] = User::where('uuid', $id)->first();
        return view('backEnd.customers.manage-customer.form', $data);
    }

    public function update(CustomerRequest $request, string $id)
    {
        try {
            $data = User::where('uuid', $id)->first();
            $data->update($this->formatCustomerData($request->all()));
            return redirect()->route('customers.manage-customer.index')->with('success', 'Customer updated Successfully.');
        }catch (\Throwable $th) {
            return redirect()->route('customers.manage-customer.index')->with('error', 'Something Went Wrong.');
        }
    }

    public function destroy(Request $request)
    {
        try{
            $staff = User::where('uuid', $request->id)->first();
            if ($staff) {
                $staff->delete();
                return response()->json(['success' => true]);
            }
            return response()->json(['success' => false], 400);
        } catch (\Throwable $e) {
            return response()->json(['success' => false], 400);
        }
    }

    public function toggleAccess(Request $request)
    {
        try {
            $customer = User::where('uuid', $request->id)->update(['status' => $request->status]);
            return response()->json(['success' => true, 'message' => 'Status Updated Successfully.']);
        } catch (\Throwable $th) {
            return response()->json(['error' => true, 'message' => 'Something Went Wrong.']);
        }
    }

    protected function formatCustomerData($payload){
        return [
            'name' => gv($payload, 'name'),
            'email' => gv($payload, 'email'),
            'mobile' => gv($payload, 'mobile'),
            'gender_id' => gv($payload, 'gender_id'),
            'date_of_birth' => $payload['date_of_birth'] ? storeDateFormat(gv($payload, 'date_of_birth')) : NULL,
            'nid' => gv($payload, 'nid'),
            'father_name' => gv($payload, 'father_name'),
            'mother_name' => gv($payload, 'mother_name'),
            'address' => gv($payload, 'address'),
            'role_id' => 4,
            'password' => bcrypt('password'),
            'status' => 1,
        ];
    }

    public function customerDetails($id, $tab)
    {
        $data['customer'] = User::where('uuid', $id)->first();
        return view('backEnd.customers.manage-customer.details', $data);
    }

    public function changePassword()
    {
        return view('backEnd.change_password');
    }

    public function changePws(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'string', 'min:8'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'password_confirmation' => ['required'],
        ]);
        try{
            $customer = User::where('uuid', auth()->user()->uuid)->first();
            if(Hash::check($request->current_password, $customer->password)){
                $customer->password = bcrypt($request->password);
                $customer->save();
                return redirect()->route('dashboard')->with('success', 'Password changed successfully.');
            }else{
                return redirect()->route('dashboard')->with('error', 'Current password is incorrect.');
            }
        }catch (\Throwable $th) {
            return redirect()->route('dashboard')->with('error', 'Something Went Wrong.');
        }
    }
}
