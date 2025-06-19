<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\TicketController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ConcertController;
use App\Http\Controllers\TicketCategoryController;
use App\Http\Controllers\LoginController;

Route::get('/', function () {
    return view('home');
});




Route::get('/login', function (){
    return view('login');
})->name('login');


Route::post('/login', [LoginController::class, 'authenticate'])->name('login.authenticate');

Route::post('/logout', function () {
    auth()->logout();
    return redirect('/login');
})->name('logout');


Route::get('/users/create', function () {
    if (auth()->check() && auth()->user()->is_admin) {
        return view('moderation.users.create');
    }
    return view('users.create');
})->name('users.create');
Route::post('/users', [UserController::class, 'store'])->name('users.store');


Route::middleware(['auth'])->group(function () {

    Route::resource('comments', CommentController::class);
    Route::resource('users', UserController::class)->except(['create', 'store']);
    Route::resource('concerts', ConcertController::class);
    Route::resource('categories', TicketCategoryController::class);
    Route::resource('ticket', TicketController::class);


    Route::get('/concerts/{id}/categories', [ConcertController::class, 'categories'])->name('concerts.categories');

    Route::get('/moderation', [\App\Http\Controllers\ModerationController::class, 'index'])->name('moderation.index');
    Route::get('/moderation/concerts', [\App\Http\Controllers\ModerationController::class, 'concerts'])->name('moderation.concerts');
    Route::get('/moderation/concerts/{id}', [\App\Http\Controllers\ModerationController::class, 'showConcert'])->name('moderation.concerts.show');
    Route::patch('/moderation/concerts/{id}/accept', [\App\Http\Controllers\ModerationController::class, 'acceptConcert'])->name('moderation.concerts.accept');

    Route::get('/concerts/{id}/buy', [ConcertController::class, 'buy'])->name('concerts.buy');
    Route::post('/concerts/{id}/buy', [ConcertController::class, 'buyComment'])->name('concerts.buy.comment');
    Route::post('/concerts/{id}/buy-ticket', [ConcertController::class, 'buyTicket'])->name('concerts.buy.ticket');
});


