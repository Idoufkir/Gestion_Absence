<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeController;
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

Route::resource('employes', EmployeController::class);
Route::resource('home', HomeController::class);

Route::get('/demo', function () {
    return view('demo');
 });

 // user protected routes
Route::group(['middleware' => ['auth', 'user'], 'prefix' => 'user'], function () {
    Route::get('/', 'HomeController@index')->name('user_dashboard');
});

// admin protected routes
Route::group(['middleware' => ['auth', 'admin'], 'prefix' => 'admin'], function () {
    Route::get('/', 'HomeController@index')->name('admin_dashboard');
});
Auth::routes();

Route::get('home', [App\Http\Controllers\HomeController::class, 'index'])->name('welcome');

Route::get('/hello', function () {
    return response()->json([
        'name' => 'Abigail',
        'state' => 'CA',
        'city' => 'KA',
    ]);
});
