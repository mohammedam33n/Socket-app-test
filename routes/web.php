<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

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

Route::get('/chat/public', function () {
    return view('chat.public');
});



Route::get('/chat/private/user/{id}', function ($id) {


    Session::flush();
    Auth::logout();
    $user = User::find($id);

    if ($user) {
        Auth::login($user);
    } else {
        // Handle the case where no user with the 'admin' role was found
        dd('User not found.');
    }

    return view('chat.private');
});
