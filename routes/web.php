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
    return view('auth.login');
});


Route::get('/dashboard', 'HomeController@index');

Route::get('/template', function () {
    return redirect('http://localhost/TaskManager/public/light-bootstrap-dashboard/dashboard.html');
})->name('tasks');



Auth::routes();

Route::get('/projectrender','HomeController@projectRender');

Route::get('/home', 'HomeController@index')->name('home');



Route::get('/settings', 'SettingsController@index' )->name('settings')->middleware('auth');

Route::post('/settings/addclient', 'SettingsController@storeClient');
Route::get('/settings/allclients', 'SettingsController@showClient');
Route::post('/settings/assignproject', 'SettingsController@storeProject');

Route::get('/selectproject', 'TaskController@selectProject');


Route::resource('/tasks', 'TaskController');