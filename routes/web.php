<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\MaterialTransactionController;

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
    return redirect()->route('materials.index');
});

Route::resource('categories', CategoryController::class);
Route::resource('materials', MaterialController::class);
Route::resource('transactions', MaterialTransactionController::class)->except(['edit', 'update', 'destroy']);

// API route for getting materials by category
Route::get('/api/categories/{category}/materials', [MaterialTransactionController::class, 'getMaterialsByCategory']);
