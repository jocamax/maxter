<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuestionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');


Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::post('/contact', [QuestionController::class, 'store'])->name('question.store');

Route::middleware('auth')->get('/questions', [\App\Http\Controllers\QuestionController::class, 'index'])
    ->name('questions.index');


Route::get('/dashboard', function () {
    return redirect('/');
})->name('dashboard');

Route::resource('products', ProductController::class)->except('show');
Route::get('/products/{product:slug}', [ProductController::class, 'show'])->name('products.show');

Route::patch('products/{product}/images/reorder', [ProductController::class, 'reorderImages'])
    ->name('products.images.reorder');
Route::get('/masine-za-farbanje', [ProductController::class, 'getMasineZaFarb'])->name('products.getMasineZaFarb');
Route::get('/masine-za-peskarenje', [ProductController::class, 'getMasineZaPesk'])->name('products.getMasineZaPesk');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
//    Route::resource('products', ProductController::class)->only('create', 'edit', 'destroy');



});

require __DIR__.'/auth.php';
