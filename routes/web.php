<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\BusinessHourController;
use App\Http\Controllers\ProfileController;
use App\Models\BusinessHour;
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('business-hour', [BusinessHourController::class, 'index'])->name('business_hours');
    Route::post('business-hour', [BusinessHourController::class, 'update'])->name('business_hours.update');
    Route::get('reserve', [AppointmentController::class, 'index'])->name('preserve');
    Route::post('reserve', [AppointmentController::class, 'reserve'])->name('reserve');
});

require __DIR__.'/auth.php';
