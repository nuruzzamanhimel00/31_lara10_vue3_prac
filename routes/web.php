<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Bitfums\ChatController;
use App\Http\Controllers\MyChat\MyChatController;

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

// ###################### Group chat route from youtube ################
Route::get('/chat-home', [App\Http\Controllers\HomeController::class, 'index_one'])->name('home');

Route::get('/chats/{id}/', 'App\Http\Controllers\ChatApp\ChatController@index');
Route::get('/messages/{id}/', 'App\Http\Controllers\ChatApp\ChatController@fetchAllMessages');
Route::post('/messages/{id}/', 'App\Http\Controllers\ChatApp\ChatController@sendMessage');
Route::post('/delete/{code}', 'App\Http\Controllers\ChatApp\ChatController@destroy');
Route::DELETE('/delete/{id}/', 'App\Http\Controllers\ChatApp\ChatController@delete');

Route::get('/group/create', 'App\Http\Controllers\ChatApp\GroupController@create_form');
Route::post('/group/create', 'App\Http\Controllers\ChatApp\GroupController@create');
Route::get('/group/join', 'App\Http\Controllers\ChatApp\GroupController@join_form');
Route::post('/group/join', 'App\Http\Controllers\ChatApp\GroupController@join');

Route::get('/subscribe', 'App\Http\Controllers\ChatApp\ChatController@subscribe');
// ###################### Group chat route from youtube ################

// ##### Chat Application practice myself ####

Route::prefix('mychat')->as('mychat.')->group(function(){
    Route::get('/dashboard', [MyChatController::class, 'dashboard'])->name('dashboard');

});



