<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ThemeController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BlogController;

// Theme Routes
Route::controller(ThemeController::class)->name('theme.')->group(function () {

  Route::get('/', 'index')->name('index');
  Route::get('/contact', 'contact')->name('contact');
});

// Subscription Routes
Route::post('/subscribe', [SubscriptionController::class, 'store'])->name('subscribe');

// Category Routes
Route::controller(CategoryController::class)->name('category.')->group(function () {

  Route::get('/category', 'index')->name('index');
  Route::get('/category/create', 'create')->name('create');
  Route::post('/category', 'store')->name('store');
  Route::get('/category/{id}/edit', 'edit')->name('edit');
  Route::put('/category/{id}/update', 'update')->name('update');
  Route::delete('/category/{id}/delete', 'destroy')->name('destroy');
});

// Blog Routes
Route::resource('/blog', BlogController::class)->middleware('auth');

Route::get('/dashboard', function () {
  return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
  Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
  Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
  Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
