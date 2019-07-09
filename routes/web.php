<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


use App\Mail\NewUserWelcomeMail;
use App\LaravelChat\ChatBox\ChatServiceProvider;
use App\Events\MessagePosted;

Auth::routes();

Route::get('/email', function (){
    return new NewUserWelcomeMail();
});

Route::get('/chat', function(){
    return view('chat.chat');
})->middleware('auth');

Route::get('/messages', function(){
    return App\Message::with('user')->get();
})->middleware('auth');

Route::post('/messages', function (){

    $user = Auth::user();

    $message = $user->messages()->create([
        'message' =>  request()->get('message')
    ]);

    event(new MessagePosted($message, $user));

    return ['status' => 'OK'];

})->middleware('auth');


Route::post('follow/{user}', 'FollowsController@store');

Route::get('/', 'PostsController@index');
Route::get('/p/create', 'PostsController@create');
Route::post('/p', 'PostsController@store');
Route::get('/p/{post}', 'PostsController@show');

Route::get('/profile/{user}', 'ProfilesController@index')->name('profile.show');
Route::get('/profile/{user}/edit', 'ProfilesController@edit')->name('profile.edit');
Route::patch('/profile/{user}', 'ProfilesController@update')->name('profile.update');
