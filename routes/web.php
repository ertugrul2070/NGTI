<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/
/*
Route::get('/welcome', function () {
    return view('welcome');
});*/

Route::get('/', function () {
    return view('authG');
});

Auth::routes();



Route::get('/welcome', 'PlannerController@getUserReservations');

Route::get('/home', 'HomeController@index');

Route::get('auth/{provider}', 'Auth\RegisterController@redirectToProvider');
Route::get('auth/{provider}/callback', 'Auth\RegisterController@handleProviderCallback');

Route::get('/planner', 'PlannerController@index');

Route::get('/planner/solo', 'PlannerController@soloIndex');
Route::get('/planner/group', 'PlannerController@getUsers');

Route::post('/planner/soloSave', 'PlannerController@soloCreate');
Route::post('/planner/groupSave', 'PlannerController@groupCreate');

Route::get('/admin', 'AdminController@index');