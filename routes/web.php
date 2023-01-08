<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FishController;
use App\Http\Controllers\TodoController;

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


Route::get('/',[TodoController::class,'home'])->name('todo#home');
Route::get('/home',[TodoController::class,'home'])->name('todo#create');

Route::post('/todos/insert',[TodoController::class,'insert'])->name('todo#insert');
Route::get('/todos/delete/{id}',[TodoController::class,'delete'])->name('todo#delete');
Route::get('/todo/detail/{id}',[TodoController::class,'detail'])->name('todo#detail');
Route::get('/todo/edit/{id}',[TodoController::class,'edit'])->name('todo#edit');
Route::post('/todo/update',[TodoController::class,'update'])->name('todo#update');

// Route::get('testing/',function (Request $request){
//     dd($request->query('name'));
// });