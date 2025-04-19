<?php

use App\Http\Controllers\ConnexionController;
use App\Http\Controllers\DeconnexionController;
use App\Http\Controllers\UserContoller;
use App\Http\Controllers\TacheController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EmployeController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function(){
    Route::get('/login',[ConnexionController::class,'show']);
    Route::post('/login', [ConnexionController::class,'login'])->name('login');
});

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function(){
    Route::post('logout',[DeconnexionController::class,'logout'])->name('logout');
    // User account routes
    Route::get('/mon-compte', [UserContoller::class, 'edit'])->name('user.edit');
    Route::put('/mon-compte', [UserContoller::class, 'update'])->name('user.update');
    
    // Tasks routes
    Route::get('/travail', [TacheController::class, 'index'])->name('taches.index');
    Route::get('/travail/create', [TacheController::class, 'create'])->name('taches.create');
    Route::post('/travail', [TacheController::class, 'store'])->name('taches.store');
    Route::get('/travail/{tache}/edit', [TacheController::class, 'edit'])->name('taches.edit');
    Route::put('/travail/{tache}', [TacheController::class, 'update'])->name('taches.update');
    Route::delete('/travail/{tache}', [TacheController::class, 'destroy'])->name('taches.destroy');
    Route::put('/taches/{tache}/etat', [TacheController::class, 'updateEtat'])->name('taches.update.etat');

    // Employees routes
    Route::get('/employes', [EmployeController::class, 'index'])->name('employes.index');
    Route::get('/employes/create', [EmployeController::class, 'create'])->name('employes.create');
    Route::post('/employes', [EmployeController::class, 'store'])->name('employes.store');
    Route::get('/employes/{employe}/edit', [EmployeController::class, 'edit'])->name('employes.edit');
    Route::put('/employes/{employe}', [EmployeController::class, 'update'])->name('employes.update');
    Route::delete('/employes/{employe}', [EmployeController::class, 'destroy'])->name('employes.destroy');
});