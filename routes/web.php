<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    Auth::loginUsingId(1);

    return redirect('/admin');
});

Route::get('/tinker', function () {
    //
});
