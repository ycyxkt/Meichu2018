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
    return view('index');
});
Route::group(['prefix' => 'm'], function() {
    Route::auth();
});
    //Auth::routes();
    /*
    // Authentication Routes...
    Route::get('login', 'Auth\AuthController@showLoginForm');
    Route::post('login', 'Auth\AuthController@login');
    Route::get('logout', 'Auth\AuthController@logout');

    // Registration Routes...
    Route::get('register', 'Auth\AuthController@showRegistrationForm');
    Route::post('register', 'Auth\AuthController@register');

    // Password Reset Routes...
    Route::get('password/reset/{token?}', 'Auth\PasswordController@showResetForm');
    Route::post('password/email', 'Auth\PasswordController@sendResetLinkEmail');
    Route::post('password/reset', 'Auth\PasswordController@reset');
    */
Route::get('/m', 'HomeController@index');

Route::group(['middleware' => ['auth', 'admin']], function(){
    Route::get('/m/register', 'Auth\RegisterController@showRegistrationForm');
    Route::post('/m/register', 'Auth\RegisterController@register');

    Route::get('/m/users', ['as' => 'users.index', 'uses' => 'UsersController@index']);
    Route::get('/m/users/{id}/edit', ['as' => 'users.edit', 'uses' => 'UsersController@edit']);
    Route::patch('/m/users/{id}', ['as' => 'users.update', 'uses' => 'UsersController@update']);
    Route::delete('/m/users/{id}', ['as' => 'users.delete', 'uses' => 'UsersController@delete']);
});
Route::group(['middleware' => ['auth', 'committee']], function(){
    Route::get('/m/games', ['as' => 'games.index', 'uses' => 'GamesController@index']);
    Route::get('/m/games/{id}/edit', ['as' => 'games.edit', 'uses' => 'GamesController@edit']);
    Route::patch('/m/games/{id}', ['as' => 'games.update', 'uses' => 'GamesController@update']);

    Route::resource('/m/teams', 'TeamsController');
});
Route::group(['middleware' => ['auth']], function(){
    Route::get('/m/changepassword', ['as' => 'changepassword', 'uses' => 'Auth\ChangePasswordController@show']);
    Route::post('/m/changepassword', 'Auth\ChangePasswordController@change');

    Route::resource('/m/losts', 'LostsController');
    Route::resource('/m/news', 'NewsController');
});