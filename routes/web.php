<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProgramController;
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

Route::get('/dashboard', function () {
	return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
	Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
	Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
	Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'verified'])->group(function () {
	Route::get('/programs', [ProgramController::class, 'index'])->name('program.index');
});

Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
	Route::get('/dashboard', [AdminController::class, 'index'])->name('index');
	Route::put('/update_programs', [AdminController::class, 'update_programs'])->name('update_programs');

	Route::get('/programs', [AdminController::class, 'get_programs'])->name('get_programs');
	Route::get('/programs_publish', [AdminController::class, 'get_programs_publish'])->name('get_programs_publish');
});

require __DIR__ . '/auth.php';
