<?php

use App\Http\Controllers\ServicesController;
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
    return view('home');
});
Route::get('/home', function () {
    return view('home');
});
Route::get('/contact-us', function () {
    return view('contact');
});
Route::get('/services-available-for-this-month-april-2024', [ServicesController::class, 'index'])->name('services');

// Route::get('/contact-us', function () {
//     return view('contact');
// })->middleware('check');

// Route::get('/services', function () {
//     return view('services');
// });

// Route::get('/services-available-for-this-month-april-2024', [ServicesController::class, 'index'])->name('services')->middleware('check');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
