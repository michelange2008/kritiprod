<?php

use App\Http\Controllers\ProfileController;
use App\Http\Livewire\AccessibleComp;
use App\Http\Livewire\ApplicationComp;
use App\Http\Livewire\LocalisationComp;
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
    
    Route::get('admin/accessible', AccessibleComp::class)->name('admin.accessible');
    Route::get('admin/application', ApplicationComp::class)->name('admin.application');
    Route::get('admin/localisation', LocalisationComp::class)->name('admin.localisation');
});

require __DIR__.'/auth.php';
