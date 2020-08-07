<?php

use Illuminate\Support\Facades\Route;

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
    return redirect(route('projects.index'));
})->name('homepage');

//Projects
Route::resource('projects', 'ProjectController');

// Tasks
Route::post('projects/{project}/tasks', 'TaskController@store')->name('tasks.store');
Route::patch('tasks/{task}', 'TaskController@update')->name('tasks.update');
Route::delete('tasks/{task}', 'TaskController@destroy')->name('tasks.destroy');
Route::patch('tasks/{task}/complete', 'TaskController@complete')->name('tasks.complete');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
