<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;
use DataTables;

class RoleMgt extends Controller
{
    public function allRoles()
    {
        return view('admin.roles.all-roles');
    }


    public function createNewRole()
    {
        return view('admin.roles.create-role');
    }

    public function storeRole(Request $request)
    {
        request()->validate(['role' => 'required']);

        $role =  Role::create(['name' => $request->role]);

        Alert::success('Success ', 'Role added successfully');

        return redirect('admin/roles');
    }


    public function fetchRoles(Request $request)
    {
        if ($request->ajax()) {
            $data = Role::get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $id = $row->id;
                    $actionBtn = "<a href='/admin/edit-role/$id'  class='edit btn btn-success btn-sm'>Edit</a> <a href='/admin/view-role/$id' class='delete btn btn-primary btn-sm'>View</a>";
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }


    public function editRole($id)
    {
        $role = Role::find($id);

        return view('admin.roles.edit-role',compact('role'));
    }

    public function updateRole(Request $request , $id)
    {
        request()->validate(['role' => 'required']);

        $role = Role::find($id);

        $role->update([
            'name' => $request->role,
        ]);

        Alert::success('Success ', 'Role updated successfully');

        return redirect('admin/roles');
    }

    public function allPermissions()
    {
        return view('admin.roles.all-permissions');
    }

    public function fetchPermissions(Request $request)
    {
        if ($request->ajax()) {
            $data = Permission::get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $id = $row->id;
                    $actionBtn = "<a href='/admin/edit-permission/$id'  class='edit btn btn-success btn-sm'>Edit</a>";
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }


    public function addPermissions()
    {
        return view('admin.roles.add-permissions');
    }

    public function storePermission(Request $request)
    {
        $request->validate(['permission' => 'required']);

        Permission::create(['name' => $request->permission]);

        Alert::success('Success ', 'Permission added successfully');

        return redirect('admin/permissions');
    }

    public function editPermission($id)
    {
      $permission =   Permission::find($id);

      return view('admin.roles.edit-permission' ,compact('permission'));
    }

    public function updatePermission(Request $request , $id)
    {
        $request->validate(['permission' => 'required']);

        $permission =   Permission::find($id);
        $permission->update([
            'name' => $request->permission,
        ]);

        Alert::success('Success ', 'Permission updated successfully');

        return redirect('admin/permissions');
    }

    public function assignPermissionToRole(Request $request)
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
            $role->givePermissionTo($permission );

            return response()->json(['success' => true , 'message' => 'Permission Granted to role successfully']);
        }else{
            $role->revokePermissionTo($permission);
            return response()->json(['success' => true , 'message' => 'Permission Revoked  successfully']);
        }

    }

    public function viewRole($id)
    {
        $role = Role::find($id);
        $permissions = Permission::all();

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

        return view('admin.roles.single-role',compact('role','permissionObject'));
    }

}
