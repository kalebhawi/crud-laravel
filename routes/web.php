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

route::resource('group', 'GroupController');

Route::post('unlinkUser', function ($id){
    $unlinkUser = \App\Http\Controllers\GroupController::unlinkUser($id);
});