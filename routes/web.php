<?php

use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

//Route::group(['middleware'=>'role:super-admin|admin'], function(){

    Route::resource('/roles', RoleController::class);
    Route::resource('/permissions', PermissionController::class);
    Route::resource('/users', UserController::class); //->middleware('permission:delete role');
    Route::get('roles/{roleId}/give-permissions', [RoleController::class,'addPermissionToRole']) ;//->name('roles.give-permissions');
    Route::put('roles/{roleId}/give-permissions', [RoleController::class,'givePermissionToRole']); //->name('roles.give-permissions.store');
    
//});