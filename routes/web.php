<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\adminController;
use App\Http\Controllers\homeController;
use Illuminate\Support\Facades\Auth;

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
    return view('client/home');
});

Route::get('/home', function () {
    return view('client/home');
});

Route::get('/daftar', [homeController::class, 'register']);

Route::post('/daftar/baru', [homeController::class, 'tambah_akun']);

Route::get('/masuk', [homeController::class, 'login']);

Route::post('/masuk', [homeController::class, 'login_check']);

Route::get('/profile', [homeController::class, 'profile']);

Route::post('/profile', [homeController::class, 'update_profile']);

Route::post('/update_password', [homeController::class, 'update_password']);

Route::get('/archive', [homeController::class, 'search_home']);

Route::post('/archive/main', [homeController::class, 'archive_main']);

Route::get('/all_archive/{page}', [homeController::class, 'archive_all']);

Route::get('/archive/{search}/{page}', [homeController::class, 'search']);

Route::get('/keluar', [homeController::class, 'logout']);

Route::get('/admin', [adminController::class, 'index'])->middleware('admin');

Route::get('/admin/menu', [adminController::class, 'index'])->middleware('admin');

Route::post('/admin/menu/user/main', [adminController::class, 'users_main'])->middleware('admin');

Route::get('/admin/menu/all_user/{page}', [adminController::class, 'user_all'])->middleware('admin');

Route::get('/admin/menu/user/{search}/{page}', [adminController::class, 'user'])->middleware('admin');

Route::get('/admin/menu/archive_all/{page}', [adminController::class, 'archive_all'])->middleware('admin');

Route::post('/masuk_admin', [adminController::class, 'login_check'])->middleware('admin');