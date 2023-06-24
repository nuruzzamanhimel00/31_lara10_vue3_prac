<?php

use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('chat', function($user){
    // return $user->id == 1;
    return ['name' => $user->name];
});


Broadcast::channel('chat{id}', function ($user) {
    return $user;
});
Broadcast::channel('send{id}', function ($user) {
    return $user;
});

//mychat
Broadcast::channel('sendsinglemessage{id}', function($user){
    // return $user->id == 1;
    return $user;
});
