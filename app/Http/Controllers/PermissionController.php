<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;


class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $permissions= Permission::get();
        return view('roles-permissions.permissions.index', ['permissions'=>$permissions]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('roles-permissions.permissions.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=> ['required','string','unique:permissions,name']
        ]);
         Permission::create(['name' => $request->name]);

         return redirect('permissions')->with('message','permission created successfully');
    }
 

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Permission $permission)
    {
        return view('roles-permissions.permissions.edit', ['permission'=>$permission]);
    
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Permission $permission)
    {
        $request->validate([
            'name'=> ['required','string','unique:permissions,name'],
        ]);
        $permission->update(['name' => $request->name]);

        return redirect('permissions')->with('message','permission updated successfully');
   
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($Permissionid)
    {
       $permission= Permission::findById($Permissionid);
       $permission->delete();
       return redirect('permissions')->with('message','permission deleted successfully');

    }
    
}
