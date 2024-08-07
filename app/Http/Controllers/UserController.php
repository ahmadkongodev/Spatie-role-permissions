<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users= User::all();
        return view('roles-permissions.users.index', ['users'=>$users]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles=Role::pluck('name','name')->all();
        return view('roles-permissions.users.create',['roles'=>$roles]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=> ['required','string'],
            'email'=> ['required','email','unique:users,email'],
            'password'=> ['required'],
            'roles'=> ['required','array'],
        ]);
        $user=User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $user->syncRoles($request->roles);
         return redirect('users')->with('message','role created successfully');
     
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $roles=Role::pluck('name','name')->all();
        $userRoles= $user->roles->pluck('name','name')->all();
        return view('roles-permissions.users.edit',
        [
            'user'=>$user,
            'roles'=>$roles,
            'userRoles'=>$userRoles,
        ]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name'=> ['required','string'],
            'email'=> ['required','email'],
            'password'=> ['nullable'],
            'roles'=> ['required','array'],
        ]);
        $data=[
            'name' => $request->name,
            'email' => $request->email
         ];
         if(!empty($request->password))
         {
            $data+=[
                'password' => Hash::make($request->password),
            ];
         }
         $user->update($data);
         return redirect('users')->with('message','user updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect('users')->with('message','user deleted successfully');

    }
}
