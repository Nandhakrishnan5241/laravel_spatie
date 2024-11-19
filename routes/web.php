<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::resource("permissions", \App\Http\Controllers\PermissionContoller::class);
Route::get("permissions/{permissionId}/delete", [\App\Http\Controllers\PermissionContoller::class,'destroy']);

Route::resource("roles", \App\Http\Controllers\RolesController::class);
Route::get("roles/{roleId}/delete", [\App\Http\Controllers\RolesController::class,'destroy']);
Route::get('roles/{roleId}/give-permissions',[\App\Http\Controllers\RolesController::class,'addPermissionToRole']);
Route::put('roles/{roleId}/give-permissions',[\App\Http\Controllers\RolesController::class,'givePermissionToRole']);

Route::resource("users", \App\Http\Controllers\UserController::class);
Route::get("users/{roleId}/delete", [\App\Http\Controllers\UserController::class,'destroy']);
