<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\AdminUserController;
use App\Http\Controllers\Auth\AdminController;

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


// ----管理者画面----
//ログイン
Route::get('/admin/login', [AdminUserController::class, 'showAdminLogin'])->name('admin.showAdminLogin');
Route::post('/admin/login', [AdminUserController::class, 'login'])->name('admin.login');
//ログアウト
Route::post('/admin/logout', [AdminUserController::class, 'adminLogout'])->name('admin.logout');
//登録
Route::get('/admin/register', [AdminUserController::class, 'showRegistrationForm'])->name('showRegistrationForm');
Route::post('/admin/register', [AdminUserController::class, 'register'])->name('register');
//ログイン認証後トップ
Route::middleware('auth.admin')->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
});


//バナー管理
Route::middleware('auth.admin')->group(function () {
    Route::get('/admin/banner_management', [AdminController::class, 'banner_management'])->name('admin.banner_management');
});
Route::delete('/admin/banner_management/{id}', [AdminController::class, 'delete'])->name('banner.delete');
Route::post('/admin/banner_management', [AdminController::class, 'create'])->name('banner.create');
Route::match(['put', 'post'], '/admin/banner_management/{id}', [AdminController::class, 'update'])->name('banner.update');



//----ユーザー----
// ユーザー時間割画面
Route::get('/authenticated/schedule', [UserController::class, 'showSchedule'])->name('showSchedule');