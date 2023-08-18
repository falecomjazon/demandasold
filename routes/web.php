<?php

use App\Http\Controllers\ProfileController;
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

Route::get('/inicio', function () {
    return view('inicio');
})->middleware(['auth', 'verified'])->name('inicio');

Route::get('/teste', function () {
    phpinfo();
})->middleware(['auth', 'verified'])->name('teste');

Route::get('/acompanhamento', function () {
    phpinfo();
})->middleware(['auth', 'verified'])->name('acompanhamento');

Route::get('/questionarios', function () {
    phpinfo();
})->middleware(['auth', 'verified'])->name('questionarios');

Route::get('/cadastro', function () {
    phpinfo();
})->middleware(['auth', 'verified'])->name('cadastro');

Route::get('/usuarios', function () {
    phpinfo();
})->middleware(['auth', 'verified'])->name('usuarios');



Route::get('/familias', function () {
    phpinfo();
})->middleware(['auth', 'verified'])->name('familias');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
