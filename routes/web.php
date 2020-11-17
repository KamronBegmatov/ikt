<?php

use Illuminate\Support\Facades\Route;

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
    return view('auth.login');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard', ['apples' => \App\Models\Apple::all()]);
})->name('dashboard');

Route::post('/dashboard/store', '\App\Http\Controllers\AppleController@store');

Route::post('/dashboard/fall', '\App\Http\Controllers\AppleController@fall');

Route::post('/dashboard/eat', '\App\Http\Controllers\AppleController@update');

Route::post('/dashboard/delete', '\App\Http\Controllers\AppleController@destroy');
