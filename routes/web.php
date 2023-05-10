<?php

use App\Http\Controllers\DemandeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Middlewares\RoleMiddleware;

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

    //demandes
    Route::get('/demandes', [DemandeController::class, 'index'])->name('demande.list');
    Route::get('/demandes/{demande}/view',[DemandeController::class, 'view'])->name('demande.view');

    Route::get('/demandes/create',[DemandeController::class, 'create'])->name('demande.create');
    Route::post('/demands', [DemandeController::class, 'store'])->name('demande.store');

    Route::get('/demandes/{demande}/view',[DemandeController::class, 'view'])->name('demande.view');
    Route::put('/demands/{demand}', [DemandeController::class, 'update'])->name('demande.update');

    Route::get('/demandes/{demande}/delete',[DemandeController::class, 'destroy'])->name('demande.destroy');



    //Users
    Route::get('/users',[UserController::class, 'index'])->name('users.list');


});

require __DIR__.'/auth.php';
