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
    return view('welcome');
});


Route::get('/dashboard', function () {
    return view('admin.dashboard');
});

Route::get('/template', function () {
    return redirect('http://localhost/TaskManager/public/light-bootstrap-dashboard/dashboard.html');
})->name('tasks');



Route::resource('/tasks', 'TaskController');
