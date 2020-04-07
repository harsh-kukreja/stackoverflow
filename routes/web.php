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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('/questions','QuestionsController')->except('show');
//After this check routeserviceprovider because hamko slug ke hisab se check karna hai not id iseleye usko modify karna padega
Route::get('/questions/{slug}','QuestionsController@show')->name('questions.show');
