<?php

namespace App\Http\new_Controllers\Eticket;

use App\Http\Controllers\Controller;
use App\Models\Tenant;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use DataTables;

class ManageRoles extends Controller
{

    public function roles()
    {
        return view('Eticket.Roles.all-roles');
    }



    public function fetchRoles(Request $request)
    {
        if ($request->ajax()) {
            $data =  Role::where(['guard_name' => 'e-ticket'])->where('tenant_id', session()->get('tenant_id'))->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $id = $row->id;
                    $actionBtn = "<a href='/e-ticket/view-role/$id' class='edit btn btn-danger btn-sm'>View</a>";
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function addNewRole()
    {
        return view('Eticket.Roles.new-role');
    }

    public function storeRole(Request $request)
    {
        request()->validate(['role' => 'required']);
        $tenant = Tenant::where('id',session()->get('tenant_id'))->first();
        $role =  Role::create(['guard_name' => 'e-ticket', 'name' => $request->role.' '.$tenant->display_name , 'tenant_id' => session()->get('tenant_id')]);

        Alert::success('Success ', 'Role added successfully');

        return redirect('e-ticket/roles');
    }

    public function viewRole($role_id)
    {
        $role = Role::find($role_id);

        $permissions = Permission::where('guard_name','e-ticket')->get();

        $permissionObject = new \stdClass();

        foreach($permissions as $index => $permission){
            if (count($role->permissions) > 0){
                foreach($role->permissions as $userPermission){
                    $permissionObject->$index['permission'] = $permission->name;
                    $permissionObject->$index['id'] = $permission->id;
                    $permissionObject->$index['status'] = ($userPermission->name == $permission->name) ? 'active' : 'not-active' ;
                    if($userPermission->name == $permission->name)
                    {
                        break;
                    }
                }
            }else{
                $permissionObject->$index['permission'] = $permission->name;
                $permissionObject->$index['id'] = $permission->id;
                $permissionObject->$index['status'] =  'not-active';
            }
        }

        return view('Eticket.Roles.single-roles',compact('role','permissionObject'));
    }

    public function addPermisisonToRole(Request $request)
    {
        $role = Role::find($request->role_id);

        if(!$role)
        {
            return response()->json(['success'=> false , 'message' => 'Role not found']);
        }
        $permission = Permission::find($request->PermissionId);

        if(!$permission)
        {
            return response()->json(['success'=> false , 'message' => 'Permission not found']);
        }


        if($request->checked == 'checked')
        {
            $role->givePermissionTo($permission);

            return response()->json(['success' => true , 'message' => 'Permission Granted to role successfully']);
        }else{
            $role->revokePermissionTo($permission);
            return response()->json(['success' => true , 'message' => 'Permission Revoked  successfully']);
        }
    }

}
