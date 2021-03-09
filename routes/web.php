<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;

Auth::routes();
Route::get('/', [BlogController::class,'index']);
Route::get('/search', [BlogController::class,'search'])->name('blog.search');

Route::resource('blog', 'BlogController');//Security Inside Class

Route::middleware('auth')->group(function () {
    Route::get('/profile', [UserController::class,'index'])->name('user');
    Route::put('/profile/{id}', [UserController::class,'update'])->name('user.update');
    Route::post('/updatePassword', [UserController::class,'update_password'])->name('user.updatePassword');    
    Route::get('/my-blogs', [HomeController::class,'index'])->name('my.blogs');
    Route::get('/home', [HomeController::class,'index'])->name('home');
});

/*--------------------Admin Panel--------------------*/
Route::prefix('admin')->namespace('Admin')->group(function () {
    Route::get('/', 'Auth\LoginController@showLoginForm');
    Route::get('login', 'Auth\LoginController@showLoginForm')->name('admin.login');
    Route::post('login', 'Auth\LoginController@login');
    Route::post('logout', 'Auth\LoginController@logout')->name('admin.logout');
    
    Route::middleware(['auth:admin'])->group(function(){
        Route::get('dashboard', 'DashboardController@index')->name('admin.dashboard');
        Route::resource('post', 'BlogsController');
    });
});