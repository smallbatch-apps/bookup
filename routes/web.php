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

Route::get('/', function () {
    return view('homepage');
});

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('/home', 'HomeController@index')->name('home');

    Route::get('/dashboard', 'HomeController@dashboard')->name('dashboard');

    Route::get('/profile', 'ProfileController@index')->name('profile');
    Route::get('/profile/edit', 'ProfileController@edit')->name('profile.edit');
    Route::post('/profile/edit', 'ProfileController@update')->name('profile.update');

    Route::get('/match/{id}', 'ProfileController@show')->name('match.show');
    Route::get('/matches', 'MatchesController@index')->name('matches');

    Route::get('messages', 'MessagesController@index')->name('messages.index');

    Route::prefix('api')->group(function () {
        Route::get('books/search', 'Books\BookController@search')->name('books.search');

        Route::get('profile/books/{type}', 'Profile\ProfileBooksController@index')->middleware('auth:web,api');
        Route::post('profile/books/{type}', 'Profile\ProfileBooksController@store')->middleware('auth:web,api');
        Route::delete('profile/books/{type}/{id}', 'Profile\ProfileBooksController@delete')
            ->middleware('auth:web,api');

        Route::resource('conversations', 'Conversation\ConversationController');

        Route::post('conversations/{id}/messages', 'Conversation\ConversationMessageController@store');
    });

});





