<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\pos\CategoryController;
use App\Http\Controllers\pos\MenuController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::controller(PublicController::class)->group(function () {
    Route::get('/', 'home')->name('public.welcome');
    Route::get('/menu', 'menu')->name('public.menu');
});

Route::get('/dashboard', [HomeController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::controller(CategoryController::class)->group(function () {
    Route::get('/all/category', 'AllCategory')->name('all.category');
    Route::post('/store/category', 'StoreCategory')->name('category.store');
    Route::get('/edit/category/{id}', 'EditCategory')->name('edit.category');
    Route::post('/update/category', 'UpdateCategory')->name('category.update');
    Route::get('/delete/category/{id}', 'DeleteCategory')->name('delete.category');
});


Route::controller(MenuController::class)->group(function () {

    Route::get('/all/menu', 'Allmenu')->name('all.menu');
    // Route::post('/store/category', 'StoreCategory')->name('category.store');
    // Route::get('/edit/category/{id}', 'EditCategory')->name('edit.category');
    // Route::post('/update/category', 'UpdateCategory')->name('category.update');
    // Route::get('/delete/category/{id}', 'DeleteCategory')->name('delete.category');
});

require __DIR__ . '/auth.php';
