<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DevController;
use App\Http\Controllers\MenuController;
use App\Http\Livewire\UserComp;
use App\Http\Livewire\AccessibleComp;
use App\Http\Livewire\ApplicationComp;
use App\Http\Livewire\LocalisationComp;
use App\Http\Livewire\PeriodeComp;
use App\Http\Livewire\DetailComp;
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

Route::get('/home', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('home');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Route générique pour l'affichage de chaque table
    Route::get('tables/{model}', DetailComp::class);
    // Route pour l'administration du site
    Route::prefix('admin')->group( function() {
        Route::get('dev', [DevController::class, 'index'])->name('dev.index');
        Route::get('dev/{model}', [DevController::class, 'show'])->name('dev.show');
        Route::get('dev/add/{model}', [DevController::class, 'add'])->name('dev.add');
        Route::post('dev/update/{model}', [DevController::class, 'update'])->name('dev.update');

        Route::get('menus', [MenuController::class, 'index'])->name('menus.index');
    });

});

require __DIR__.'/auth.php';
