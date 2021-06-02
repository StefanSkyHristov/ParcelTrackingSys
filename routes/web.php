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

Route::get('/branch/create', 'App\Http\Controllers\BranchController@create')->name('branch.create');
Route::post('/branch/store', 'App\Http\Controllers\BranchController@store')->name('branch.store');
Route::get('/branch/show', 'App\Http\Controllers\BranchController@index')->name('branch.index');
