<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('login', 'API\LoginController@login');
Route::post('logout', 'API\LoginController@logout')->middleware('auth:api');
Route::get('refresh', 'API\LoginController@refresh');

Route::get('permissions/all', 'API\PermissionController@all')->middleware(['auth:api', 'permission:permissions-all']);
Route::get('permissions', 'API\PermissionController@index')->middleware(['auth:api', 'permission:permissions-index']);
Route::post('permissions', 'API\PermissionController@store')->middleware(['auth:api', 'permission:permissions-create']);
Route::get('permissions/{id}', 'API\PermissionController@show')->middleware(['auth:api', 'permission:permissions-show']);
Route::put('permissions/{id}', 'API\PermissionController@update')->middleware(['auth:api', 'permission:permissions-edit']);
Route::delete('permissions/{id}', 'API\PermissionController@destroy')->middleware(['auth:api', 'permission:permissions-destroy']);

Route::get('roles/all', 'API\RoleController@all')->middleware(['auth:api', 'permission:roles-all']);
Route::get('roles', 'API\RoleController@index')->middleware(['auth:api', 'permission:roles-index']);
Route::post('roles', 'API\RoleController@store')->middleware(['auth:api', 'permission:roles-create']);
Route::get('roles/{id}', 'API\RoleController@show')->middleware(['auth:api', 'permission:roles-show']);
Route::put('roles/{id}', 'API\RoleController@update')->middleware(['auth:api', 'permission:roles-edit']);
Route::delete('roles/{id}', 'API\RoleController@destroy')->middleware(['auth:api', 'permission:roles-destroy']);

Route::get('admins', 'API\AdminController@index')->middleware(['auth:api', 'permission:admins-index']);
Route::post('admins', 'API\AdminController@store')->middleware(['auth:api', 'permission:admins-create']);
Route::get('admins/{id}', 'API\AdminController@show')->middleware(['auth:api', 'permission:admins-show']);
Route::put('admins/{id}', 'API\AdminController@update')->middleware('auth:api', 'permission:admins-edit', 'verify.oldPassword');
Route::delete('admins/{id}', 'API\AdminController@destroy')->middleware(['auth:api', 'permission:admins-destroy']);

Route::get('user', 'API\AuthController@index')->middleware('auth:api');