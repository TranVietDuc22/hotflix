<?php

use Illuminate\Support\Facades\Route;
use Livewire\Livewire;


//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/', \App\Livewire\Home\Home::class)->name('home');

Route::get('/register', \App\Livewire\Auth\Register::class);
Route::get('/login', \App\Livewire\Auth\Login::class)->name('login');
Route::get('/search', \App\Livewire\Film\ResultSearch::class)->name('home.search');
Route::get('/film/{uuid}', \App\Livewire\Film\FilmDetail::class)->name('film.detail');
Route::get('/browser/{uuid}/{sourceTable}', \App\Livewire\Film\Browser::class)->name('film.browser');

Route::middleware(['auth'])->group(function () {
    Route::get('/favorite', \App\Livewire\User\Favorite::class)->name('user.favorite');
    Route::get('/profile', \App\Livewire\User\Profile::class)->name('user.profile');
});

Route::get('/forget-password', \App\Livewire\Auth\ForgotPassword::class)->name('forget-password');
Route::get('/reset-password/{token}', \App\Livewire\Auth\ResetPassword::class)->name('password.reset');

Route::get('/logout', function (){
    \Illuminate\Support\Facades\Auth::logout();
    return redirect()->route('login');
})->name('logout');

Route::get('/email/verify', function () {
    return view('livewire.auth.verify-email');
})->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', [\App\Http\Controllers\VerifyController::class, 'verifyEmail'])
    ->name('verification.verify');

Route::post('/email/resend')->middleware(['auth', 'throttle:6,1'])->name('verification.resend');
