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


Route::get('/', [homeController::class, 'home_page']);

Route::get('/home', [homeController::class, 'home_page']);

Route::get('/daftar', [homeController::class, 'register']);

Route::post('/daftar/baru', [homeController::class, 'tambah_akun']);

Route::get('/masuk', [homeController::class, 'login']);

Route::get('/archive_pinjam', [homeController::class, 'peminjaman_page']);

Route::post('/masuk', [homeController::class, 'login_check']);

Route::post('/unggah_file', [homeController::class, 'unggah_file']);

Route::get('/profile', [homeController::class, 'profile']);

Route::post('/profile', [homeController::class, 'update_profile']);

Route::post('/update_password', [homeController::class, 'update_password']);

Route::get('/archive', [homeController::class, 'search_home']);

Route::post('/archive/main', [homeController::class, 'archive_main']);

Route::post('/archive/pinjam', [homeController::class, 'peminjaman_arsip']);

Route::get('/all_archive/{page}', [homeController::class, 'archive_all']);

Route::get('/archive/{search}/{page}', [homeController::class, 'search']);

Route::get('/keluar', [homeController::class, 'logout']);

Route::get('/login_admin_page', [adminController::class, 'login_admin_page']);

Route::post('/login_admin', [adminController::class, 'login_admin']);

Route::get('/admin', [adminController::class, 'index'])->middleware('admin');

Route::get('/admin/menu', [adminController::class, 'index'])->middleware('admin');

Route::post('/admin/menu/user/main', [adminController::class, 'users_main'])->middleware('admin');

Route::get('/admin/menu/all_user/{page}', [adminController::class, 'user_all'])->middleware('admin');

Route::get('/admin/menu/user/{search}/{page}', [adminController::class, 'user'])->middleware('admin');

Route::get('/admin/menu/archive/{search}/{page}', [adminController::class, 'archive'])->middleware('admin');

Route::get('/admin/menu/archive_all/{page}', [adminController::class, 'archive_all'])->middleware('admin');

Route::get('/admin/menu/peminjaman_arsip/{page}', [adminController::class, 'peminjaman_arsip'])->middleware('admin');

Route::post('/admin/menu/archive/tambah_archive', [adminController::class, 'tambah_archive_baru']);

Route::post('/admin/menu/archive/cari', [adminController::class, 'cari_arsip'])->middleware('admin');

Route::get('/admin/menu/archive/getDownload', [adminController::class, 'getDownload']);

Route::get('/admin/menu/archive/delete_arsip', [adminController::class, 'delete_arsip'])->middleware('admin');

Route::post('/admin/menu/archive/update_arsip', [adminController::class, 'update_arsip'])->middleware('admin');

Route::post('/masuk_admin', [adminController::class, 'login_check'])->middleware('admin');

Route::get('/admin/menu/archive/bacaSurat', [adminController::class, 'bacaSurat'])->middleware('admin');