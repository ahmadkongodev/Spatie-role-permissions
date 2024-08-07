<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    public function index()
    {
        $roles= Role::get();
        return view('roles-permissions.roles.index', ['roles'=>$roles]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('roles-permissions.roles.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=> ['required','string','unique:roles,name']
        ]);
        Role::create(['name' => $request->name]);

         return redirect('roles')->with('message','role created successfully');
    }
 

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        return view('roles-permissions.roles.edit', ['role'=>$role]);
    
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name'=> ['required','string','unique:roles,name'],
        ]);
        $role->update(['name' => $request->name]);

        return redirect('roles')->with('message','role updated successfully');
   
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($Roleid)
    {
       $role= Role::findById($Roleid);
       $role->delete();
       return redirect('roles')->with('message','role deleted successfully');

    }
    public function addPermissionToRole($roleId)
    {
        $role= Role::findOrFail($roleId);
        $permissions= Permission::get();
        $rolePermissions = DB::table('role_has_permissions')
        ->where('role_has_permissions.role_id', $role->id)
        ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
        ->all();
        return view('roles-permissions.roles.add-permissions',['role'=>$role, 'permissions'=>$permissions , 'rolePermissions'=>$rolePermissions ]);
    }
    public function givePermissionToRole($roleId, Request $request){
        $request->validate([
            'permissions' => ['required', 'array'],
        ]);
        $role=Role::findOrFail($roleId);
        $role->syncPermissions($request->permissions);
        return redirect('roles')->with('message','roles added to role');

    }
}
