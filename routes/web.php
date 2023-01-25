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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', function () {
    return redirect('/login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/order', [App\Http\Controllers\OrderController::class, 'index'])->name('order');
Route::get('/domain-register', [App\Http\Controllers\OrderController::class, 'domainRegister']);
Route::post('/check-domain/{domain}', [App\Http\Controllers\OrderController::class, 'checkDomainAjax']);

