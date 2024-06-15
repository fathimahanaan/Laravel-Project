<?php

use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\VacanciesController;
use App\Http\Controllers\ProfileController;
use Barryvdh\Debugbar\Facades\Debugbar;
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
    DebugBar::info('Showing the Message!');
    return view('welcome');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('/vacancies', VacanciesController::class);
Route::view('/admin/dashboard', 'admin.dashboard')->middleware(['auth','admin']);

Route::resource('/categories', CategoriesController::class)->middleware('can:is admin');
require __DIR__.'/auth.php';
