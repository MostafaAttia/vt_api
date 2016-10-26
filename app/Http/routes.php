<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::get('/home', 'HomeController@index');


// Admin Routes ...

Route::group(['prefix' => 'admin'], function() {

    Route::get('/', 'AdminController@welcome');
    Route::get('manage', 'AdminController@manageAdmins');
    Route::get('create', 'AdminController@create');
    Route::post('create', 'AdminController@store');


//    Route::get('/manage', ['middleware' => ['permission:manage-admins'], 'uses' => 'AdminController@manageAdmins']);
});


