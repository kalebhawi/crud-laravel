<?php
use Illuminate\Support\Facades\Input;
use App\User;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('home');
});

Route::get('/about', function () {
    return view('about');
});

Auth::routes();

route::resource('client', 'ClientController');
