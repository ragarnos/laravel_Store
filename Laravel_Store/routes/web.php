<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::name('admin.')->prefix('admin')->middleware(['auth', 'admin'])->group(function() {
    Route::get('/dashboard', function () {
        return view('dashboard', ['role' => 'Admin']);
    })->name('dashboard');

    Route::resource('products', \App\Http\Controllers\Admin\ProductsController::class)->except(['show']);
});



Route::get('/dashboard', function () {
    return view('dashboard', ['role' => 'Customer']);
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

//Route::prefix('posts')->name('posts')->group(function(){
//    Route::get('/', [Controller::class, 'index']);
//    Route::post('/', [Controller::class, 'store'])->name('.store');
//    Route::get('create', [Controller::class, 'index'])->name('.create');
//    Route::get('{post}/create', [Controller::class, 'index'])->name('.update');
//});
