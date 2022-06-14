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

Route::get('/buku_pinjam', [homeController::class, 'peminjaman_page_buku']);

Route::post('/masuk', [homeController::class, 'login_check']);

Route::post('/unggah_file', [homeController::class, 'unggah_file']);

Route::get('/profile', [homeController::class, 'profile']);

Route::post('/profile', [homeController::class, 'update_profile']);

Route::post('/update_password', [homeController::class, 'update_password']);

Route::get('/layanan/{submenu}', [homeController::class, 'search_home']);

Route::post('/archive/main', [homeController::class, 'archive_main']);

Route::post('/buku/main', [homeController::class, 'buku_main']);

Route::post('/archive/pinjam', [homeController::class, 'peminjaman_arsip']);

Route::post('/buku/pinjam_buku', [homeController::class, 'peminjaman_buku']);

Route::get('/all_archive/{page}', [homeController::class, 'archive_all']);

Route::get('/all_book/{page}', [homeController::class, 'book_all']);

Route::get('/archive/{search}/{page}', [homeController::class, 'search']);

Route::get('/book/{search}/{page}', [homeController::class, 'book_search']);

Route::get('/buku/detail_buku/{id}', [homeController::class, 'detail_buku']);

Route::get('/keluar', [homeController::class, 'logout']);

Route::get('/batal_pinjam_user/{id}', [homeController::class, 'batal_pinjam_user']);

Route::get('/buku/batal_pinjam/{id}', [homeController::class, 'batal_pinjam_buku_user']);

Route::get('/login_admin_page', [adminController::class, 'login_admin_page']);

Route::post('/login_admin', [adminController::class, 'login_admin']);

Route::get('/admin', [adminController::class, 'index'])->middleware('admin');

Route::get('/admin/menu', [adminController::class, 'index'])->middleware('admin');

Route::get('/keluar_admin', [adminController::class, 'logout_admin'])->middleware('admin');

Route::post('/admin/menu/user/main', [adminController::class, 'users_main'])->middleware('admin');

Route::get('/admin/menu/all_user/{page}', [adminController::class, 'user_all'])->middleware('admin');

Route::get('/admin/menu/user/{search}/{page}', [adminController::class, 'user'])->middleware('admin');

Route::get('/admin/menu/archive/{search}/{page}', [adminController::class, 'archive'])->middleware('admin');

Route::get('/admin/menu/buku/{search}/{page}', [adminController::class, 'e_book'])->middleware('admin');

Route::get('/admin/menu/archive_all/{page}', [adminController::class, 'archive_all'])->middleware('admin');

Route::get('/admin/menu/buku_all/{page}', [adminController::class, 'buku_all'])->middleware('admin');

Route::get('/admin/menu/kategori_tag_all/{page}/{tab}', [adminController::class, 'kategori_tag_all'])->middleware('admin');

Route::get('/admin/menu/peminjaman_arsip/{page}', [adminController::class, 'peminjaman_arsip'])->middleware('admin');

Route::get('/admin/menu/peminjaman_buku/{page}', [adminController::class, 'peminjaman_buku'])->middleware('admin');

Route::post('/admin/menu/archive/tambah_archive', [adminController::class, 'tambah_archive_baru'])->middleware('admin');

Route::post('/admin/menu/archive/cari', [adminController::class, 'cari_arsip'])->middleware('admin');

Route::post('/admin/menu/buku/cari', [adminController::class, 'cari_buku'])->middleware('admin');

Route::get('/admin/menu/archive/getDownload', [adminController::class, 'getDownload'])->middleware('admin');

Route::get('/admin/menu/archive/delete_arsip', [adminController::class, 'delete_arsip'])->middleware('admin');

Route::post('/admin/menu/archive/update_arsip', [adminController::class, 'update_arsip'])->middleware('admin');

Route::post('/masuk_admin', [adminController::class, 'login_check'])->middleware('admin');

Route::get('/admin/menu/archive/bacaSurat', [adminController::class, 'bacaSurat'])->middleware('admin');

Route::post('/admin/menu/archive/konfirmasi_peminjaman_arsip', [adminController::class, 'konfirmasi_peminjaman_arsip'])->middleware('admin');

Route::post('/admin/menu/buku/konfirmasi_peminjaman_buku', [adminController::class, 'konfirmasi_peminjaman_buku'])->middleware('admin');

Route::get('/admin/konfirmasi_selesai/{id}', [adminController::class, 'konfirmasi_selesai'])->middleware('admin');

Route::get('/admin/buku/tambah_kategori', [adminController::class, 'tambah_kategori'])->middleware('admin');

Route::get('/admin/buku/tambah_tag', [adminController::class, 'tambah_tag'])->middleware('admin');

Route::get('/admin/buku/tambah_tagtobuku', [adminController::class, 'tambah_tagtobuku'])->middleware('admin');

Route::post('/admin/buku/tambah_buku', [adminController::class, 'tambah_buku'])->middleware('admin');

Route::post('/admin/buku/update_buku', [adminController::class, 'update_buku'])->middleware('admin');

Route::get('/admin/buku/hapus_buku/{id}', [adminController::class, 'hapus_buku'])->middleware('admin');

Route::get('/admin/buku/tag/{id}/{page}', [adminController::class, 'hapus_tag'])->middleware('admin');

Route::get('/admin/buku/kategori/{id}/{page}', [adminController::class, 'hapus_kategori'])->middleware('admin');

Route::get('/admin/buku/detail/{id}', [adminController::class, 'detail_buku'])->middleware('admin');

Route::get('/admin/buku/hapus_detail_buku_tag/{id}', [adminController::class, 'hapus_detail_buku_tag'])->middleware('admin');

Route::get('/admin/buku/hapus_peminjaman/{id}', [adminController::class, 'hapus_peminjaman'])->middleware('admin');
