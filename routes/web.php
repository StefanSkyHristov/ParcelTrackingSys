<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/admin', 'App\Http\Controllers\AdminController@index')->name('admin.index');
Route::get('/logout', 'App\Http\Controllers\HomeController@logout')->name('logout');

Route::get('/parcel/create', 'App\Http\Controllers\ParcelController@create')->name('parcel.create');
Route::post('/parcel/store', 'App\Http\Controllers\ParcelController@store')->name('parce.store');
Route::get('/parcel/show', 'App\Http\Controllers\ParcelController@index')->name('parcel.index');

Route::get('/parcel/show/submitted', 'App\Http\Controllers\ParcelController@submitted')->name('parcel.submitted');
Route::get('/parcel/show/withcourrier', 'App\Http\Controllers\ParcelController@withCourrier')->name('parcel.with_courrier');
Route::patch('/parcel/{parcel}/updateStatus', 'App\Http\Controllers\ParcelController@updateStatus')->name('parcel.updateStatus');
Route::get('/parcel/{parcel}/edit', 'App\Http\Controllers\ParcelController@edit')->name('parcel.edit');
Route::patch('/parcel/{parcel}/update', 'App\Http\Controllers\ParcelController@update')->name('parcel.update');
Route::get('/parcel/track', 'App\Http\Controllers\ParcelController@track')->name('parcel.track');
Route::post('/parcel/progress', 'App\Http\Controllers\ParcelController@progress')->name('parcel.progress');
Route::delete('/parcel/{parcel}/delete', 'App\Http\Controllers\ParcelController@destroy')->name('parcel.destroy');

Route::get('/admin/users', 'App\Http\Controllers\UserController@index')->name('users.index');
Route::get('/admin/users/{user}/edit', 'App\Http\Controllers\UserController@edit')->name('users.edit');
Route::put('/admin/users/{user}/update', 'App\Http\Controllers\UserController@update')->name('users.update');
Route::delete('/admin/users/{user}/delete', 'App\Http\Controllers\UserController@destroy')->name('users.destroy');
Route::put('/admin/users/{user}/attach', 'App\Http\Controllers\UserController@attach')->name('users.attach');
Route::put('/admin/users/{user}/detach', 'App\Http\Controllers\UserController@detach')->name('users.detach');

Route::get('/branch/create', 'App\Http\Controllers\BranchController@create')->name('branch.create');
Route::post('/branch/store', 'App\Http\Controllers\BranchController@store')->name('branch.store');
Route::get('/branch/show', 'App\Http\Controllers\BranchController@index')->name('branch.index');

Route::post('/roles/store', 'App\Http\Controllers\RoleController@store')->name('roles.store');
Route::get('/roles/show', 'App\Http\Controllers\RoleController@show')->name('roles.index');
Route::get('/roles/{role}/edit', 'App\Http\Controllers\RoleController@edit')->name('roles.edit');
Route::delete('/roles/{role}/delete', 'App\Http\Controllers\RoleController@destroy')->name('roles.destroy');

Route::post('/permissions/store', 'App\Http\Controllers\PermissionController@store')->name('permissions.store');
Route::get('/permissions/show', 'App\Http\Controllers\PermissionController@index')->name('permissions.index');
Route::delete('/permissions/{permission}/delete', 'App\Http\Controllers\PermissionController@destroy')->name('permissions.destroy');
