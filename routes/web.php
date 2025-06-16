<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ConcertController;
use App\Http\Controllers\TicketCategoryController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/hello', function (){
    return view('hello',['title'=>'Hello world!']);
});

// User routes
Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show');

// Concert routes
Route::get('/concerts', [ConcertController::class, 'index'])->name('concerts.index');
Route::get('/concerts/{id}', [ConcertController::class, 'show'])->name('concerts.show');
Route::get('/concerts/{id}/categories', [ConcertController::class, 'categories'])->name('concerts.categories');

// Ticket category routes
Route::get('/categories', [TicketCategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/{id}', [TicketCategoryController::class, 'show'])->name('categories.show');


