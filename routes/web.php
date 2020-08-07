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

// Route::get('/', function () {
//     return view('welcome');
// });

// APIのURL以外のリクエストに対してはindexテンプレートを返す
// 画面遷移はフロントエンドのVueRouterが制御する
// Route::get('/{any?}', fn() => view('index'))->where('any', '.+');
// Route::get('/{any?}', function() {
//   return view('index')->where('any', '.+');
// });

Route::resource('/post', 'PostController');
// Route::get('/', 'PostController@index')->name('post.index');
// Route::post('post', 'PostController@store')->name('post.store'); // 保存

// Route::get('/', function () {
//     return view('layouts.app');
// });

// Route::get('/', function () {
//   return 'Hello World';
// });
