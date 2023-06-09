<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Bitfums\ChatController;

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::as('realtime.')->group(function(){
    Route::get('/realtime-chat', [ChatController::class, 'index'])->name('chat');
    Route::get('/realtime-chat-bitfums', [ChatController::class, 'bitfumsIndex'])->name('chat.bitfums');
    Route::post('/realtime-chat-bitfums/sendMessage', [ChatController::class, 'bitfumSendMessage'])->name('chat.bitfums.sendMessage');
});

