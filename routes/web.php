<?php

use App\Http\Controllers\DemandeController;
use App\Http\Controllers\FormationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
// use Spatie\Permission\Middlewares\checkUserRole;

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

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'App\Http\Middleware\CheckUserRole:chef'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //demandes
    Route::middleware('App\Http\Middleware\CheckUserRole:chef,agent')->group(function(){
        Route::get('/demandes', [DemandeController::class, 'index'])->name('demande.list');
        Route::get('/demandes/{demande}/view',[DemandeController::class, 'view'])->name('demande.view');
        Route::get('/demandes/create',[DemandeController::class, 'create'])->name('demande.create');
        Route::post('/demands', [DemandeController::class, 'store'])->name('demande.store');

        Route::get('/demandes/{demande}/view',[DemandeController::class, 'view'])->name('demande.view');
        Route::put('/demands/{demand}', [DemandeController::class, 'update'])->name('demande.update');

        Route::post('/demands/{demande}/accept', [DemandeController::class, 'accepter'])->name('demande.accepter');
        Route::post('/demands/{demande}/rejeter', [DemandeController::class, 'rejeter'])->name('demande.rejeter');
        Route::post('/demands/{demande}/admis', [DemandeController::class, 'admis'])->name('demande.admis');
        Route::post('/demands/{demande}/non_admis', [DemandeController::class, 'nonAdmis'])->name('demande.non_admis');
        Route::post('/demands/{demande}/recupere', [DemandeController::class, 'recupere'])->name('demande.recupere');
        Route::post('/demands/{demande}/add_paiement', [DemandeController::class, 'storePaymentFile'])->name('demande.storePaymentFile');
        Route::get('demande/download/{filename}',[DemandeController::class, 'downloadFile'])->name('demande.downloadFile');

        Route::post('/demands/{demande}/attach',[DemandeController::class, 'attachFormation'])->name('demande.attachFormation');

        Route::delete('/demandes/{demande}/delete',[DemandeController::class, 'destroy'])->name('demande.destroy');
    });

    //Users
    Route::middleware('App\Http\Middleware\CheckUserRole:chef,admin')->group(function(){
        Route::get('/users',[UserController::class, 'index'])->name('user.list');
        Route::get('/users/new',[UserController::class, 'create'])->name('user.create');
        Route::get('/users/{user}/edit',[UserController::class, 'edit'])->name('user.edit');
        Route::post('/users/store/{id?}',[UserController::class, 'store'])->name('user.store');
        Route::delete('/users/{user}/destroy',[UserController::class, 'destroy'])->name('user.destroy');
    });

    //Formations
    Route::get('/formations',[FormationController::class, 'index'])->name('formation.list');
    Route::get('/formations/{formation}/view',[FormationController::class, 'view'])->name('formation.view');
    Route::post('/formations/store',[FormationController::class, 'store'])->name('formation.store');
    Route::get('/formations/{formation}/view',[FormationController::class, 'view'])->name('formation.view');
    Route::delete('/formations/{formation}/delete',[FormationController::class, 'destroy'])->name('formation.destroy');






});

require __DIR__.'/auth.php';
