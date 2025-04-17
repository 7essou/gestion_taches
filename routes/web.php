<?php

use App\Http\Controllers\UserContoller;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {return view('login');})->name('/');
Route::get('test', function () {return view('test');})->name('test');
Route::post('/', [UserContoller::class,'auth'])->name('auth');
