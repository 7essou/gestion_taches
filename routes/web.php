<?php

use App\Http\Controllers\ConnexionController;
use App\Http\Controllers\UserContoller;
use Illuminate\Support\Facades\Route;
Route::middleware('guest')->group(function(){
Route::get('/login',[ConnexionController::class,'show']);
Route::post('/login', [ConnexionController::class,'login'])->name('login');
});
Route::get('/', function () {return view('test');})->name('/');