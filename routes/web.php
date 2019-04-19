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

/*Route::get('/', function () {
    return view('welcome');
});
*/

Route::get('/', function () {
    return view('index');
})->name('index');


//註冊會員可用
Route::group(['middleware' => 'auth'],function(){
    Route::get('/inside', function () {
    return view('inside');
})->name('inside');
});


//管理者可用
Route::group(['middleware' => 'admin'],function(){

//顯示新增公告的表單
Route::get('posts/create','PostsController@create')->name('posts.create');
//出現要修改的指定公告
Route::get('posts/{post}/edit','PostsController@edit')->name('posts.edit');

//實際儲存修改好的公告資料
Route::patch('posts/{post}','PostsController@update')->name('posts.update');

//刪除指定的公告
Route::delete('posts/{post}/destroy','PostsController@destroy')->name('posts.destroy');
/*Auth::routes();*/

//實際POST儲存公告資料
Route::post('posts/store','PostsController@store')->name('posts.store');

});








//顯示最新公告列表
Route::get('posts','PostsController@index')->name('posts.index');

//秀出指定公告
Route::get('posts/{post}/show','PostsController@show')->name('posts.show');

//下載公告附件
Route::get('download/{id}/{filename}','PostsController@download')->name('posts.download');

#登入
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
#登出
Route::get('logout', 'Auth\LoginController@logout')->name('logout');

#註冊
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register')->name('register.post');

#忘記密碼
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');



Route::get('/home', 'HomeController@index')->name('home');
