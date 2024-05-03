<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MyController;

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
    return view('index');
});
Route::post('/',[MyController::class,'insertStudent']);
Route::get('select',[MyController::class,'selectAllStudents']);
Route::get('edit/{id}',[MyController::class,'editStudent']);
Route::post('edit/{id}',[MyController::class,'updateStudent']);
Route::get('delete/{id}',[MyController::class,'delete']);