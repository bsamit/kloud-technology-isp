<?php

namespace App\Http\Controllers\Customers;

use App\Models\User;
use App\Http\CommonList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerRequest;
use App\Models\PotentialCustomer;

class PotentialCustomerController extends Controller
{
    public $getAllList;

    public function __construct(CommonList $allList){
        $this->getAllList = $allList;
    }

    public function index()
    {
        $data['potential_customers'] = PotentialCustomer::get();
        return view('backEnd.customers.potential-customer.index', $data);
    }

    public function addToActiveCustomer($id)
    {
        try{
            $pCustomer = PotentialCustomer::where('uuid', $id)->first();
            if ($pCustomer) {
                $customer = new User();
                $customer->name = $pCustomer->name;
                $customer->email = $pCustomer->email;
                $customer->mobile = $pCustomer->mobile;
                $customer->gender_id = 1;
                $customer->role_id = 4;
                $customer->date_of_birth = NULL;
                $customer->nid = NULL;
                $customer->address = $pCustomer->address;
                $customer->password =  bcrypt($pCustomer->password);
                $customer->status =  1;
                $customer->save();
                $pCustomer->delete();
            }
            return response()->json(['success' => true, 'message' => 'Added To Active Customer'], 200);
        } catch (\Throwable $e) {
            dd($e);
            return response()->json(['success' => false], 400);
        }
    }
}
