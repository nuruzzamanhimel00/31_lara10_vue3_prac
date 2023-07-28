<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Bitfums\ChatController;
use App\Http\Controllers\CalenderController;
use App\Http\Controllers\MyChat\MyChatController;
use App\Http\Controllers\MyChat\MyGroupController;

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
    Route::controller(MyChatController::class)->group(function () {

        Route::get('/dashboard','dashboard')->name('dashboard');

    });
    Route::controller(MyGroupController::class)->group(function () {
        Route::get('/make-group','makeGroup')->name('make.group');
        Route::post('/make-group','makeGroupSubmit')->name('make.group.submit');
        Route::get('/group-list','makeGroupList')->name('make.group.list');
        Route::post('/group-join','makeGroupJoin')->name('make.group.join');
        Route::get('/group-member-list/{gId}','groupMemberList')->name('group.member.list');
        Route::get('/group/{gId}/member/{uId}/delete','groupMemberDelete')->name('group.member.delete');
        Route::get('/group-chat/{gId}','groupChat')->name('group.groupChat');
        //get all messages
        Route::get('/group/{gId}/messages','groupAllMessages')->name('group.Messages');
        Route::post('/group/{gId}/sendMessage','groupSendMessage')->name('group.sendMessage');
    });



});

Route::get('/full-calender-list', [CalenderController::class, 'list'])->name('fullcalender.list');
Route::get('/full-calender-index', [CalenderController::class, 'fullCalenderIndex'])->name('fullcalender.index');
