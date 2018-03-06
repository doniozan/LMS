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
    return view('home');
});

Route::get('/setupsources', 'masterData\SourcesController@index');
Route::post('/setupsources/add', 'masterData\SourcesController@add');
Route::get('/setupsources/search/{id_sources}', 'masterData\SourcesController@search');
Route::post('/setupsources/edit', 'masterData\SourcesController@edit');
Route::get('/setupsources/delete/{id_sources}', 'masterData\SourcesController@delete');

Route::get('/setupstatuses', 'masterData\StatusesController@index');
Route::post('/setupstatuses/add', 'masterData\StatusesController@add');
Route::get('/setupstatuses/search/{id_statuses}', 'masterData\StatusesController@search');
Route::post('/setupstatuses/edit', 'masterData\StatusesController@edit');
Route::get('/setupstatuses/delete/{id_statuses}', 'masterData\StatusesController@delete');

Route::get('/setupdepartment', 'masterData\DepartmentController@index');
Route::post('/setupdepartment/add', 'masterData\DepartmentController@add');
Route::get('/setupdepartment/search/{id_department}', 'masterData\DepartmentController@search');
Route::post('/setupdepartment/edit', 'masterData\DepartmentController@edit');
Route::get('/setupdepartment/delete/{id_department}', 'masterData\DepartmentController@delete');

Route::get('/setupstaff', 'masterData\StaffController@index');
Route::post('/setupstaff/add', 'masterData\StaffController@add');
Route::get('/setupstaff/search/{id_staff}', 'masterData\StaffController@search');
Route::post('/setupstaff/edit', 'masterData\StaffController@edit');
Route::get('/setupstaff/delete/{id_staff}', 'masterData\StaffController@delete');