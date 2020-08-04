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
})->name('home');

Route::resource('projects', 'ProjectController');
Route::post('projects/{project}/tasks/create', 'ProjectController@storeTask')->name('tasks.store');
Route::patch('projects/tasks/{task}/completed', 'ProjectController@completed')->name('tasks.completed');
