<?php

use App\Http\Controllers\ExportController;
use App\Http\Controllers\ImportController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return view('auth.login');
});
Route::get('/product', [ProductController::class, 'index'])->middleware(['auth', 'verified'])->name('product.index');
Route::get('/product/create', [ProductController::class, 'create'])->middleware(['auth', 'verified'])->name('product.create');
Route::post('/product', [ProductController::class, 'store'])->middleware(['auth', 'verified'])->name('product.store');
Route::get('/product/{id}/edit', [ProductController::class, 'edit'])->middleware(['auth', 'verified'])->name('product.edit');
Route::put('/product/{id}/update', [ProductController::class, 'update'])->middleware(['auth', 'verified'])->name('product.update');
Route::delete('/product/{id}/destroy', [ProductController::class, 'destroy'])->middleware(['auth', 'verified'])->name('product.destroy');


Route::get('/dashboard', [ProductController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');
// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/import', [ImportController::class,'index'])->middleware(['auth', 'verified'])->name('import.index');
Route::get('/import/create', [ImportController::class, 'create'])->middleware(['auth', 'verified'])->name('import.create');
Route::post('/import', [ImportController::class, 'store'])->middleware(['auth', 'verified'])->name('import.store');
Route::get('/import/{id}/edit', [ImportController::class, 'edit'])->middleware(['auth', 'verified'])->name('import.edit');
Route::put('/import/{id}/update', [ImportController::class, 'update'])->middleware(['auth', 'verified'])->name('import.update');
Route::delete('/import/{id}/destroy', [ImportController::class, 'destroy'])->middleware(['auth', 'verified'])->name('import.destroy');

Route::get('/export', [ExportController::class,'index'])->middleware(['auth', 'verified'])->name('export.index');
Route::get('/export/create', [ExportController::class, 'create'])->middleware(['auth', 'verified'])->name('export.create');
Route::post('/export/product', [ExportController::class, 'store'])->middleware(['auth', 'verified'])->name('export.store');
Route::get('/export/{id}/edit', [ExportController::class, 'edit'])->middleware(['auth', 'verified'])->name('export.edit');
Route::put('/export/{id}/update', [ExportController::class, 'update'])->middleware(['auth', 'verified'])->name('export.update');
Route::delete('/export/{id}/destroy', [ExportController::class, 'destroy'])->middleware(['auth', 'verified'])->name('export.destroy');


Route::get('/report', [ExportController::class, 'report'])->middleware(['auth', 'verified'])->name('report');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
