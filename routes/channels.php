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
    return (string) $user->id === (string) $id;
});

Broadcast::channel('online-status.{id}', function ($user, $id) {
    return $user->isConnection($id);
});


Broadcast::channel('chats.{id}.{cardId}.{authId}', function ($user, $id, $cardId, $authId) {
    return $user->id == $authId;
});


// Broadcast::channel('online-status', function ($user) {
//     return true; // Optionally add authorization logic here
// });

// Broadcast::channel('my-channel', function () {
//     return true; // Optionally add authorization logic here
// });
