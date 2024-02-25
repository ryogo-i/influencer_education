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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// ユーザートップ画面
Route::get('/user/top', [App\Http\Controllers\UserController::class, 'showTop'])->name('user.top');

// ユーザープロフィール変更画面
Route::get('/user/profile', [App\Http\Controllers\UserController::class, 'showProfile'])->name('user.profile');
Route::post('/user/profile', [App\Http\Controllers\UserController::class, 'updateProfile'])->name('user.updateProfile');

// ユーザーパスワード変更画面
Route::get('/user/password', [App\Http\Controllers\UserController::class, 'editPassword'])->name('user.password');
Route::post('/user/update_password', [App\Http\Controllers\UserController::class, 'updatePassword'])->name('user.updatePassword');

// ユーザーお知らせ
Route::get('/user/article/{id}', [App\Http\Controllers\ArticleController::class, 'userShow'])->name('article');

// ユーザー授業進捗画面
Route::get('/user/class_progress', [App\Http\Controllers\CurriculumProgressController::class, 'indexProgress'])->name('class.progress');

// 授業（配信）ページ
Route::get('/user/curriculum/{id}', [App\Http\Controllers\CurriculumController::class, 'showCurriculum'])->name('user.curiiculum.show');

// 管理お知らせ一覧
Route::get('/admin/article_list', [App\Http\Controllers\ArticleController::class, 'articleList'])->name('article.list');
// 管理お知らせ 削除ボタン
Route::post('/admin/article_delete/{id}', [App\Http\Controllers\ArticleController::class, 'articleDelete'])->name('admin.deleteArticle');

// 管理お知らせ新規作成
Route::get('/admin/article_create', [App\Http\Controllers\ArticleController::class, 'createArticle'])->name('admin.createArticle');
Route::post('/admin/article_store', [App\Http\Controllers\ArticleController::class, 'storeArticle'])->name('admin.storeArticle');

// 管理お知らせ変更
Route::get('/admin/article_edit/{id}', [App\Http\Controllers\ArticleController::class, 'editArticle'])->name('admin.editArticle');
Route::post('/admin/article/{id}', [App\Http\Controllers\ArticleController::class, 'updateArticle'])->name('admin.updateArticle');
