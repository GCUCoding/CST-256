<?php

/*
 * |--------------------------------------------------------------------------
 * | Web Routes
 * |--------------------------------------------------------------------------
 * |
 * | Here is where you can register web routes for your application. These
 * | routes are loaded by the RouteServiceProvider within a group which
 * | contains the "web" middleware group. Now create something great!
 * |
 */
Route::get('/', function () 
{
    return view('home');
});

Route::get('/home', function ()
{
    return view('home');
});

Route::get('/register', function () 
{
    return view('registration');
});

Route::post('/registered', 'RegisterController@index');

Route::get('/login', function()
{
   return view('login'); 
});

Route::post('/logged', 'LoginController@index');

Route::get('/logged', 'LoginController@userAccess');

Route::post('/editUser', 'AdminController@editUser');

Route::get('/editUser', function()
{
    return view();
});

Route::post('/editedUser', 'AdminController@confirmEditUser');

Route::get('/editedUser', function()
{
    return view('security');
});

Route::post('/deleteUser', 'AdminController@deleteUser');

Route::post('/editedUserInfo', 'CustomerController@editUserInfo');

Route::post('/editUserProfile', 'AdminController@editUserProfile');

Route::post('/editedUserProfile', 'AdminController@editedUserProfile');

Route::get('/logout', 'LoginController@Logout');