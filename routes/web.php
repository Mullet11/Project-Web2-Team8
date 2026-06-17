<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard.index');
});

Route::post('/register', function () {
    return redirect('/?registered=1');
});

Route::post('/login', function () {
    return redirect('/dashboard?login=1');
});
