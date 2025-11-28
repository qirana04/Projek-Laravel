<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MedicineController;
use App\Http\Controllers\DiseaseController;
use App\Http\Controllers\SearchController;

Route::get('/', function () {
    return redirect()->route('medicines.index');
});

// Medicines CRUD
Route::resource('medicines', MedicineController::class);

// Diseases CRUD (simple)
Route::resource('diseases', DiseaseController::class)->except(['show']);

// Search (GET)
Route::get('search', [SearchController::class, 'index'])->name('search.index');
