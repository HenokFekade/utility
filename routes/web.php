<?php

use App\Http\Controllers\PhoneController;
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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/phone', [PhoneController::class, 'index'])->name('phone');

Route::post('/initiate_call', [PhoneController::class, 'initiateCall'])->name('initiate_call');

Route::post('/initiate_message', [PhoneController::class, 'initiateMessage'])->name('initiate_message');

require __DIR__.'/auth.php';
