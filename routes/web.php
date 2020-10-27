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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/about', function () {
//     return view('pages.about');
// });

Route::get('/user/{id}/{name}', function ($id, $name) {
    return "this user is ".$name." With Id ". $id;
});

Route::get('/', 'PagesController@index');
Route::get('/pages', 'PagesController@index');
Route::get('/about', 'PagesController@about');
Route::get('/services', 'PagesController@services');

Route::resource('/post', 'PostController');
Auth::routes();

Route::get('/dashboard', 'DashboardController@index')->name('home');

/*--------------------Admin Panel--------------------*/
Route::get('/admin', 'Auth\admin\LoginController@showLoginForm')->name('admin');

Route::prefix('admin')->namespace('Auth\admin')->group(function(){
    $this->get('login','LoginController@showLoginForm')->name('admin.login');
    $this->post('login','LoginController@login');
    $this->post('logout','LoginController@logout')->name('admin.logout');
});
Route::prefix('admin')->namespace('Admin')->group(function(){
    $this->get('dashboard','DashboardController@index')->name('admin.dashboard');
});