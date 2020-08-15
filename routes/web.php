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

// Route::resource('/post', 'PostController');
// トップページへアクセスする時にユーザー登録の認証をつける
Route::resource('/post', 'PostController')->middleware('auth');

// testビューにて＠sectionの挙動確認
// Route::get('/test', function () {
//   return view('test.test_child');
// });

// resourceにまとめる前のCRUD機能
// Route::get('/', 'PostController@index')->name('post.index');
// Route::post('post', 'PostController@store')->name('post.store'); // 保存
// Route::get('post/create', 'PostController@create')->name('post.create'); // 作成
// Route::get('post/{post_id}', 'PostController@show')->name('post.show'); // 表示
// Route::get('post/edit/{post_id}', 'PostController@edit')->name('post.edit'); // 編集
// Route::put('post/{post_id}', 'PostController@update')->name('post.update'); // 更新
// Route::delete('post/{post_id}', 'PostController@destroy')->name('post.destroy'); // 削除

Auth::routes();
Route::get('/', 'HomeController@index')->name('home');
Route::get('/logout', 'UserController@getLogout')->name('user.logout');