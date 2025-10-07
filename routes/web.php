<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\CitaController;


Route::get('/',[WelcomeController::class,'welcome'])->name('welcome');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    //ruta categorias
    Route::resource('/categoria',CategoriaController::class);
    //ruta productos
    Route::resource('/producto',ProductoController::class);
    //ruta productos
    Route::resource('/cita', CitaController::class);
    //pdf
    Route::get('/pdfProductos', [PdfController::class, 'pdfProductos'])->name('pdf.productos');
    // pdf de citas
    Route::get('/pdfCitas', [PdfController::class, 'pdfCitas'])->name('pdf.citas');


    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
