<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;


Route::get('/',[ChatController::class, 'index'])->name('dashboard')->middleware('auth');

Auth::routes();
Route::post('/logout', [HomeController::class, 'logout'])->name('logout');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/get-messages', [ChatController::class, 'getMessages'])->name('getMessages');
Route::post('/send-message', [ChatController::class, 'sendMessage'])->name('sendMessage');
Route::post('mail/send', [ChatController::class, 'sendMail'])->name('sendMail');
Route::post('status-seen', [ChatController::class, 'statusSeen'])->name('statusSeen');


