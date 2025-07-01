<?php

namespace Modules\HR\App\Http\Controllers;

use Exception;
use App\Models\User;
use App\Http\CommonList;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Modules\HR\App\Http\Requests\StaffRequest;

class StaffController extends Controller
{
    public $getAllList;

    public function __construct(CommonList $allList){
        $this->getAllList = $allList;
    }

    public function index()
    {
        $data['staffs'] = User::whereNotIn('role_id', [1,4])->get();
        return view('hr::staff.index', $data);
    }

    public function create()
    {
        $data['roles']  = $this->getAllList->getStaffRoleList();
        return view('hr::staff.form', $data);
    }

    public function store(StaffRequest $request)
    {
        try {
            $roleData = Role::where('id', $request->role_id)->first();

            $userData = User::create($this->formatStaffData($request->all()));
            $userData->syncRoles([$roleData->name]);

            return redirect()->route('human-resources.manage-staff.index')->with('success', 'Staff Created Successfully.');
        } catch (Exception $e) {
            dd($e);
            return redirect()->route('human-resources.manage-staff.index')->with('error', 'Something Went Wrong.');
        }
    }

    public function edit($id)
    {
        $data['roles']  = $this->getAllList->getStaffRoleList();
        $data['editData'] = User::where('uuid', $id)->first();
        if (!$data['editData']) {
            return redirect()->route('human-resources.manage-staff.index')->with('error', 'Staff not found.');
        }
        return view('hr::staff.form', $data);
    }

    public function update(StaffRequest $request, $id)
    {
        try {
            $staff = User::where('uuid', $id)->firstOrFail();
            $staff->update($this->formatStaffData($request->all()));

            $roleData = Role::where('id', $staff->role_id)->first();
            $staff->syncRoles([$roleData->name]);

            return redirect()->route('human-resources.manage-staff.index')->with('success', 'Staff updated successfully.');
        } catch (Exception $e) {
            dd($e);
            return redirect()->route('human-resources.manage-staff.index')->with('error', 'Something Went Wrong.');
        }
    }


    public function destroy($id)
    {
        try{
            $staff = User::where('uuid', $id)->first();
            if ($staff) {
                $staff->delete();
                return response()->json(['success' => true]);
            }
            return response()->json(['success' => false], 400);
        } catch (Exception $e) {
            return response()->json(['success' => false], 400);
        }
    }


    protected function formatStaffData($payload){
        return [
            'name' => gv($payload, 'name'),
            'email' => gv($payload, 'email'),
            'mobile' => gv($payload, 'mobile'),
            'gender_id' => gv($payload, 'gender_id'),
            'role_id' => gv($payload, 'role_id'),
            'date_of_birth' => $payload['date_of_birth'] ? storeDateFormat(gv($payload, 'date_of_birth')) : NULL,
            'nid' => gv($payload, 'nid'),
            'salary' => gv($payload, 'salary'),
            'father_name' => gv($payload, 'father_name'),
            'mother_name' => gv($payload, 'mother_name'),
            'address' => gv($payload, 'address'),
            'ref_details' => gv($payload, 'ref_details'),
            'password' => bcrypt('password'),
            'status' => gv($payload, 'status'),
        ];
    }
}
