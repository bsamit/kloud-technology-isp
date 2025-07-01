<?php

namespace Modules\HR\App\Http\Controllers;

use Exception;
use App\Models\User;
use App\Http\CommonList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public $getAllList;

    public function __construct(CommonList $allList){
        $this->getAllList = $allList;
    }

    public function index()
    {
        try{
            $data['roles'] = Role::whereNotIn('id', [1, 4])->get();
            return view('hr::role.index', $data);
            return redirect()->route('human-resources.role.index')->with('success', 'Role Created Successfully.');
        }catch (Exception $th) {
            return redirect()->route('human-resources.role.index')->with('error', 'Something Went Wrong.');
        }
    }

    public function store(Request $request)
    {
        try{
            $validated = $request->validate([
                'name' => 'required|string|max:50',
            ]);
            Role::create([
                'name' => $validated['name']
            ]);
            return redirect()->route('human-resources.role.index')->with('success', 'Role Created Successfully.');
        }catch (Exception $e) {
            return redirect()->route('human-resources.role.index')->with('error', 'Something Went Wrong.');
        }
    }

    public function edit($id)
    {
        try{
            $role = Role::find($id);
            if($role){
                $roles = Role::whereNotIn('id', [1, 4])->get();
                return view('hr::role.index',compact('roles','id','role'));
            }else{
                return redirect()->route('human-resources.role.index')->with('warning', "Role Doesn't Exists");
            }
        }catch (Exception $th) {
            return redirect()->route('human-resources.role.index')->with('error', 'Something Went Wrong.');
        }
    }

    public function update(Request $request)
    {
        try{
            $request->validate([
                'name' => ['required', 'string', 'max:50', 'unique:roles,name,'.$request->id],
            ]);

            $role = Role::find($request->id);
            if($role){
                $role->update(['name' => $request->name]);
                return redirect()->route('human-resources.role.index')->with('success', 'Role Updated Successfully.');
            }else{
                return redirect()->route('human-resources.role.index')->with('warning', "Role Doesn't Exists");
            }
        }catch (Exception $th) {
            dd($th);
            return redirect()->route('human-resources.role.index')->with('error', 'Something Went Wrong.');
        }
    }


    public function addPermissionToRole($roleId)
    {
        try{
            $role = Role::find($roleId);
            if($role){
                $permissions = Permission::orderBy('id', 'desc')->get();
                $rolePermissions = DB::table('role_has_permissions')
                                    ->where('role_has_permissions.role_id', $role->id)
                                    ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
                                    ->all();
                return view("hr::permission.add-permissions", compact('role','permissions','rolePermissions'));
            }else{
                return redirect()->route('human-resources.role.index')->with('warning', "Role Doesn't Exists");
            }
        }catch (Exception $th) {
            return redirect()->route('human-resources.role.index')->with('error', 'Something Went Wrong.');
        }
    }

    public function givePermissionToRole(Request $request)
    {
        $request->validate([
            'permissions' => 'required'
        ]);
        $role = Role::findOrFail($request->role_id);
        $role->syncPermissions($request->permissions);
        return redirect()->back()->with('success', 'Permission Updated Successfully.');
    }

    public function assignRoleToUser(Request $request)
    {
        try {
            $user = User::find($request->user_id);
            if ($user) {
                $roles = Role::whereIn('name', [$request->roles])->get();
                if ($roles->count() > 0) {
                    $user->syncRoles($roles);
                    return redirect()->back()->with('success', 'Role Updated Successfully.');
                } else {
                    return redirect()->back()->with('error', 'Rone Not  Found.');
                }
            } else {
                return redirect()->back()->with('error', 'User not Found.');
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e], 404);
        }
    }
}
