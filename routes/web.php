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
// Route::get('admin', function(){
//     return redirect()->route('admin.login');
// });

Route::prefix('admin')->namespace('Auth\admin')->group(function(){    
    $this->get('login','LoginController@showLoginForm')->name('admin.login');
    $this->post('login','LoginController@login');
    $this->post('logout','LoginController@logout')->name('admin.logout');
});
Route::prefix('admin')->middleware(['auth:admin'])->namespace('admin')->group(function(){    
    $this->get('/user','UsersController@index');
    $this->get('dashboard','DashboardController@index')->name('admin.dashboard');
    
    $this->get('/adminuser','UsersController@admin')->name('admin.adminuser');
    $this->get('/adminuser/create','UsersController@create_admin')->name('admin.createadminuser');
    $this->post('/adminuser/create','UsersController@create_admin');
    $this->get('/adminuser/edit/{id}','UsersController@edit_admin')->name('admin.editadminuser');
    $this->post('/adminuser/edit/{id}','UsersController@edit_admin');
    $this->post('/adminuser/delete', 'UsersController@delete_admin');

    $this->get('/user','UsersController@user')->name('admin.user');
    $this->get('/user/create','UsersController@create_user')->name('admin.createuser');
    $this->post('/user/create','UsersController@create_user');
    $this->get('/user/edit/{id}','UsersController@edit_user')->name('admin.edituser');
    $this->post('/user/edit/{id}','UsersController@edit_user');
    $this->post('/user/delete', 'UsersController@delete_user');

    $this->get('/cmspage','MasterController@cmspage')->name('admin.cmspage');
    $this->get('/cmspage/create','MasterController@create_cmspage')->name('admin.createcmspage');
    $this->post('/cmspage/create','MasterController@create_cmspage');
    $this->get('/cmspage/edit/{id}','MasterController@edit_cmspage')->name('admin.editcmspage');
    $this->post('/cmspage/edit/{id}','MasterController@edit_cmspage');
    $this->post('/cmspage/delete', 'MasterController@delete_cmspage');
});


/*--------JUST FOR TESTING--------*/
Route::get('sendbasicemail','MailController@basic_email');
Route::get('sendhtmlemail','MailController@html_email');
Route::get('sendattachmentemail','MailController@attachment_email');