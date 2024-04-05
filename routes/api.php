<?php

use App\Http\Controllers\Api\SclassController;
use App\Http\Controllers\Api\SubjectController;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
//Class route
//get data
Route::get('/class',[SclassController::class,'Index']);

//insert route
Route::post('/class/store',[SclassController::class,'Store']);

//get by id data route
Route::get('/class/edit/{id}',[SclassController::class,'Edit']);

//update route
Route::post('/class/update/{id}',[SclassController::class,'Update']);

//delete by id data route
Route::get('/class/delete/{id}',[SclassController::class,'Delete']);

//Subject route
//get data
Route::get('/subject',[SubjectController::class,'Index']);

//insert route
Route::post('/subject/store',[SubjectController::class,'Store']);

//get by id data route
Route::get('/subject/edit/{id}',[SubjectController::class,'Edit']);

//update route
Route::post('/subject/update/{id}',[SubjectController::class,'Update']);

//delete by id data route
Route::get('/subject/delete/{id}',[SubjectController::class,'Delete']);