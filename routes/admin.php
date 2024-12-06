<?php

use Illuminate\Support\Facades\Route;

Route::group(['namespace' => "App\Http\Livewire\Admin", "as" => "admin."], function () {

    Route::get('logout', "Auth\Login@logout")->name('logout');

    Route::group(['middleware' => ['AdminAuth']], function () {

        Route::get('login', "Auth\Login")->name('login');
        Route::get('dashboard', "Dashboard\Home")->name('dashboard');
    });
});
