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
    return view('Pages.dashboard');
});
Route::resource('department','DepartmentController');
Route::post('department/delete/{id}','DepartmentController@destroy');
Route::post('department/update/{id}', 'DepartmentController@update');

Route::resource('stclass','StudentClassController');
Route::post('stclass/delete/{id}','StudentClassController@destroy');
Route::post('stclass/update/{id}', 'StudentClassController@update');


Route::resource('section','StudentSectionController');
Route::post('section/delete/{id}','StudentSectionController@destroy');
Route::post('section/update/{id}', 'StudentSectionController@update');

Route::resource('student','StudentController');
Route::post('student/delete/{id}','StudentController@destroy');
Route::post('student/update/{id}', 'StudentController@update');

Route::resource('report','reportController');
Route::get('report','reportController@index');

Route::resource('array','ArrayController');




