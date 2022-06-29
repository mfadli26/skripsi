<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Upload;
use Illuminate\Support\Facades\File;
use Response;
use Illuminate\Contracts\Routing\ResponseFactory;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\DBAL\TimestampType;
use Laravel\Ui\Presets\React;
use RealRashid\SweetAlert\Facades\Alert;

class adminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $conten = DB::table('content_home')
            ->get();

        $data = (object) [
            'sidebar' => 'home',
            'breadcrumb' => 'Dashboard',
            'breadcrumbsub' => '1',
            'konten' => $conten
        ];

        return view('admin.admin')->with('data', $data);
    }

    public function login_admin_page()
    {
        return view('admin.login_admin');
    }

    public function bacaSurat(Request $request)
    {
        $file = $request->query("file");
        $file_location = public_path('storage\bukti_izin\\' . $file);
        return response()->download($file_location);
    }

    public function login_admin(Request $request)
    {
        $data = [
            'email'     => $request->email,
            'password'  => $request->password
        ];
        Auth::attempt($data);
        if (Auth::check()) {
            if (Auth::user()->admin == 0) {
                $user = Auth::user();
                $data = (object) ['user' => $user];

                return view('client.home')->with('data', $data);
            } else {
                return $this->index();;
            }
        } else {
            return redirect()->back()->with('fail', 'gagal');
        }
    }

    public function users_main(Request $request)
    {
        $search = $request->search;
        if ($search == "") {
            return redirect('admin/menu/all_user/1/');
        } else {
            return redirect('admin/menu/user/' . $search . '/1');
        }
    }

    public function cari_arsip(Request $request)
    {
        $search = $request->search;
        if ($search == "") {
            return redirect('admin/menu/archive_all/1/');
        } else {
            return redirect('admin/menu/archive/' . $search . '/1');
        }
    }

    public function cari_buku(Request $request)
    {
        $search = $request->search;
        if ($search == "") {
            return redirect('admin/menu/book_all/1/');
        } else {
            return redirect('admin/menu/buku/' . $search . '/1');
        }
    }

    public function cari_buku_peminjaman(Request $request)
    {
        $search = $request->search;
        if ($search == "") {
            alert::warning('Kode Pemesanan Tidak Ditemukan', 'Pastikan Huruf Besar Dan Kecil Sesuai');
            return redirect('/admin/menu/peminjaman_buku/1/zero');
        } else {
            return redirect('/admin/menu/peminjaman_buku/1/1/' . $search);
        }
    }

    public function cari_arsip_peminjaman(Request $request)
    {
        $search = $request->search;
        if ($search == "") {
            alert::warning('Kode Pemesanan Tidak Ditemukan', 'Pastikan Huruf Besar Dan Kecil Sesuai');
            return redirect()->back();
        } else {
            return redirect('/admin/menu/peminjaman_arsip/1/1/' . $search);
        }
    }

    public function archive_all($page)
    {
        $archive = DB::table('archive')
            ->skip(($page - 1) * 20)
            ->take(20)
            ->get();

        $jumlah = DB::table('archive')
            ->count();

        $page_jumlah = $jumlah / 20;

        $data = (object) [
            'sidebar' => "pelayanan",
            'breadcrumbsub' => 'Data Arsip',
            'breadcrumb' => 'Pelayanan',
            'archive' => $archive,
            'page' => $page,
            'search' => "",
            'check_count' => $jumlah,
            'jumlah_page' => $page_jumlah,
        ];

        return view('admin.archive')->with('data', $data);
    }

    public function buku_all($page)
    {
        $limit = ($page - 1) * 2;
        $buku = DB::select(
            DB::raw('
            SELECT buku.*, kategory, tag
            FROM buku 
            LEFT JOIN kategori_buku ON buku.id_kategori = kategori_buku.id
            LEFT JOIN detail_buku_tag ON buku.id = detail_buku_tag.id_buku
            LEFT JOIN (SELECT tag_buku.id, GROUP_CONCAT(tag) AS tag FROM tag_buku) AS tag_buku ON tag_buku.id = detail_buku_tag.id_tag
            GROUP BY buku.id limit 20 offset ' . $limit . '')
        );

        $buku_count = DB::table('buku')
            ->count();

        $page_jumlah = $buku_count / 20;
        $kategori = DB::table('kategori_buku')
            ->get();

        $tag = DB::table('tag_buku')
            ->get();

        $jumlah = DB::table('buku')
            ->count();

        $data = (object) [
            'sidebar' => "pelayanan",
            'breadcrumbsub' => 'Data Buku',
            'breadcrumb' => 'Pelayanan',
            'buku' => $buku,
            'page' => $page,
            'search' => "",
            'jumlah' => $jumlah,
            'kategori' => $kategori,
            'tag' => $tag,
            'check_count' => $jumlah,
            'jumlah_page' => $page_jumlah,
        ];

        return view('admin.buku')->with('data', $data);
    }

    public function detail_buku($id)
    {
        $buku = DB::table('buku')
            ->select('buku.*', 'kategori_buku.*', 'buku.id AS id_buku')
            ->leftjoin('kategori_buku', 'buku.id_kategori', '=', 'kategori_buku.id')
            ->where('buku.id', '=', $id)
            ->get();

        $tag_buku = DB::table('detail_buku_tag')
            ->select('tag_buku.*', 'detail_buku_tag.id AS id_detail_tag')
            ->rightjoin('buku', 'detail_buku_tag.id_buku', '=', 'buku.id')
            ->Join('tag_buku', 'detail_buku_tag.id_tag', '=', 'tag_buku.id')
            ->where('detail_buku_tag.id_buku', '=', $id)
            ->get();

        $tag_buku_jumlah = $tag_buku->count();

        $kategori = DB::table('kategori_buku')
            ->get();

        $tag = DB::table('tag_buku')
            ->whereNotIn('tag_buku.id', function ($query) use ($id) {
                $query->select('detail_buku_tag.id_tag')->from('detail_buku_tag')
                    ->where('detail_buku_tag.id_buku', '=', $id);
            })
            ->get();

        $data = (object) [
            'sidebar' => "pelayanan",
            'breadcrumbsub' => 'Data Buku',
            'breadcrumb' => 'Pelayanan',
            'buku' => $buku,
            'tag_buku' => $tag_buku,
            'kategori' => $kategori,
            'tag' => $tag,
            'tag_buku_jumlah' => $tag_buku_jumlah
        ];

        return view('admin.buku_detail')->with('data', $data);
    }



    public function hapus_detail_buku_tag($id)
    {
        DB::table('detail_buku_tag')
            ->where('id', '=', $id)
            ->delete();

        Alert::success('Berhasil', 'Tag berhasil dihapus');
        return redirect()->back();
    }

    public function kategori_tag_all($page, $tab)
    {
        $jumlah = DB::table('kategori_buku')
            ->count();

        $jumlah_tag = DB::table('tag_buku')
            ->count();

        $page_kategori_jumlah = $jumlah / 10;

        $page_tag_jumlah = $jumlah_tag / 10;

        if ($tab == 2) {
            $tab = 'kategori';
            $page_kat = 1;
            $page_tag = 1;
        } elseif ($tab == 'kategori') {
            $page_kat = $page;
            $page_tag = 1;
        } elseif ($tab == 'tag') {
            $page_kat = 1;
            $page_tag = $page;
        }

        $kategori = DB::table('kategori_buku')
            ->skip(($page_kat - 1) * 10)
            ->take(10)
            ->get();

        $tag = DB::table('tag_buku')
            ->skip(($page_tag - 1) * 10)
            ->take(10)
            ->get();

        $data = (object) [
            'sidebar' => "pelayanan",
            'breadcrumbsub' => 'Kategori & Tag E-Book',
            'breadcrumb' => 'Pelayanan',
            'tab' => $tab,
            'tag' => $tag,
            'page' => $page,
            'page_kat' => $page_kat,
            'page_tag' => $page_tag,
            'search' => "",
            'jumlah' => $jumlah,
            'jumlah_tag' => $jumlah_tag,
            'kategori' => $kategori,
            'jumlah_page' => $page_kategori_jumlah,
            'jumlah_page_tag' => $page_tag_jumlah
        ];

        return view('admin.kategori_tag')->with('data', $data);
    }

    public function tambah_kategori(Request $request)
    {
        $query = DB::table('kategori_buku')
            ->where('kategory', '=', $request->kategori)
            ->count();

        if ($query > 0) {
            Alert::warning('Gagal!', 'Kategori telah tersedia');
        } else {
            DB::table('kategori_buku')
                ->insert([
                    'kategory' => $request->kategori
                ]);
            Alert::success('Berhasil!', 'Kategori berhasil ditambah');
        }
        return redirect()->back();
    }

    public function edit_kategori(Request $request)
    {
        DB::table('kategori_buku')
            ->where('id', '=', $request->id)
            ->update([
                'kategory' => $request->kategori
            ]);

        alert::success('Berhasil', 'Data kategori berhasil diubah');
        return redirect()->back();
    }

    public function tambah_tag(Request $request)
    {
        $query = DB::table('tag_buku')
            ->where('tag', '=', $request->tag)
            ->count();

        $page = $request->page;
        $data_tab = 'tag';

        if ($query > 0) {
            Alert::warning('Gagal!', 'Tag telah tersedia');
        } else {
            DB::table('tag_buku')
                ->insert([
                    'tag' => $request->tag
                ]);
            Alert::success('Berhasil!', 'tag berhasil ditambah');
        }
        return redirect('/admin/menu/kategori_tag_all/' . $page . '/' . $data_tab);
    }

    public function edit_tag(Request $request)
    {
        DB::table('tag_buku')
            ->where('id', '=', $request->id)
            ->update([
                'tag' => $request->tag
            ]);

        $page = $request->page;
        $data_tab = 'tag';

        alert::success('Berhasil', 'Data tag berhasil diubah');

        return redirect('/admin/menu/kategori_tag_all/' . $page . '/' . $data_tab);
    }

    public function tambah_buku(Request $request)
    {
        if ($request->file('cover') == null) {
            $filename = 'cover-buku-default.jpg';
        } else {
            $file = $request->file('cover');
            $filename = time() . "_" . $request->nomor_arsip . "." . $request->file->getClientOriginalExtension();
            $file->move(base_path('\storage\app\public\cover_buku'), $filename);
        }

        DB::table('buku')
            ->insert([
                'judul' => $request->judul,
                'penerbit' => $request->penerbit,
                'penulis' => $request->penulis,
                'tahun_terbit' => $request->tahun,
                'id_kategori' => $request->id_kategori,
                'stock_buku' => $request->stock_buku,
                'cover' => $filename
            ]);

        Alert::success('Berhasil', 'Buku berhasil ditambahkan!');
        return redirect()->back();
    }

    public function tambah_tagtobuku(Request $request)
    {
        DB::table('detail_buku_tag')
            ->insert([
                'id_buku' => $request->id_buku,
                'id_tag' => $request->id_tag
            ]);

        Alert::success('Berhasil', 'Data tag buku berhasil ditambahkan!');
        return redirect()->back();
    }

    public function update_buku(Request $request)
    {
        $id = $request->id_buku;
        $query = DB::table('buku')
            ->where('id', '=', $id);

        $query->update([
            'judul' => $request->judul,
            'penerbit' => $request->penerbit,
            'penulis' => $request->penulis,
            'tahun_terbit' => $request->tahun,
            'id_kategori' => $request->id_kategori,
            'stock_buku' => $request->stock_buku
        ]);

        Alert::success('Berhasil', 'Data buku berhasil diubah');
        return redirect()->back();
    }

    public function hapus_buku($id)
    {
        DB::table('buku')
            ->where('id', '=', $id)
            ->delete();

        Alert::success('Berhasil!', 'Data buku berhasil dihapus');
        return redirect()->back();
    }

    public function hapus_tag($id, $page)
    {
        DB::table('tag_buku')
            ->where('id', '=', $id)
            ->delete();

        $data_tab = 'tag';
        Alert::success('Berhasil!', 'Data tag berhasil dihapus');
        return redirect('/admin/menu/kategori_tag_all/' . $page . '/' . $data_tab);
    }

    public function hapus_kategori($id, $page)
    {
        DB::table('kategori_buku')
            ->where('id', '=', $id)
            ->delete();

        $data_tab = 'kategori';
        Alert::success('Berhasil!', 'Data kategori berhasil dihapus');
        return redirect('/admin/menu/kategori_tag_all/' . $page . '/' . $data_tab);
    }

    public function peminjaman_arsip($tab, $page, $search)
    {
        if ($tab == 'konfirmasi') {
            $page_konfirmasi = $page;
            $page_unggah = 1;
            $page_pengambilan = 1;
            $page_selesai = 1;
            $page_batal = 1;
        } elseif ($tab == 'unggah') {
            $page_konfirmasi = 1;
            $page_unggah = $page;
            $page_pengambilan = 1;
            $page_selesai = 1;
            $page_batal = 1;
        } elseif ($tab == 'pengambilan') {
            $page_konfirmasi = 1;
            $page_unggah = 1;
            $page_pengambilan = $page;
            $page_selesai = 1;
            $page_batal = 1;
        } elseif ($tab == 'selesai') {
            $page_konfirmasi = 1;
            $page_unggah = 1;
            $page_pengambilan = 1;
            $page_selesai = $page;
            $page_batal = 1;
        } elseif ($tab == 'batal') {
            $page_konfirmasi = 1;
            $page_unggah = 1;
            $page_pengambilan = 1;
            $page_selesai = 1;
            $page_batal = $page;
        } else {
            $page_konfirmasi = 1;
            $page_unggah = 1;
            $page_pengambilan = 1;
            $page_selesai = 1;
            $page_batal = 1;
        }
        $peminjaman_konfirmasi = DB::table('peminjaman_arsip')
            ->select('archive.*', 'peminjaman_arsip.update_at AS update_peminjaman', 'peminjaman_arsip.*', 'users.*', 'users_admin.name AS name_admin', 'peminjaman_arsip.id AS id_peminjaman')
            ->where('status', '=', 'Menunggu Konfirmasi')
            ->join('users', 'peminjaman_arsip.id_users', '=', 'users.id')
            ->join('archive', 'peminjaman_arsip.id_archive', '=', 'archive.id')
            ->leftjoin('users AS users_admin', 'peminjaman_arsip.id_admin', '=', 'users_admin.id')
            ->orderByDesc('update_peminjaman')
            ->skip(($page_konfirmasi - 1) * 20)
            ->take(20)
            ->get();

        $peminjaman_unggahfile = DB::table('peminjaman_arsip')
            ->select('archive.*', 'peminjaman_arsip.update_at AS update_peminjaman', 'peminjaman_arsip.*', 'users.*', 'users_admin.name AS name_admin', 'peminjaman_arsip.id AS id_peminjaman')
            ->where('status', '=', 'Unggah Izin')
            ->orWhere('status', '=', 'File Izin Ditolak')
            ->join('users', 'peminjaman_arsip.id_users', '=', 'users.id')
            ->join('archive', 'peminjaman_arsip.id_archive', '=', 'archive.id')
            ->leftjoin('users AS users_admin', 'peminjaman_arsip.id_admin', '=', 'users_admin.id')
            ->orderByDesc('update_peminjaman')
            ->skip(($page_unggah - 1) * 20)
            ->take(20)
            ->get();

        $peminjaman_pengambilan = DB::table('peminjaman_arsip')
            ->select('archive.*', 'peminjaman_arsip.update_at AS update_peminjaman', 'peminjaman_arsip.*', 'users.*', 'users_admin.name AS name_admin', 'peminjaman_arsip.id AS id_peminjaman')
            ->where('status', '=', 'Pengambilan Arsip')
            ->join('users', 'peminjaman_arsip.id_users', '=', 'users.id')
            ->join('archive', 'peminjaman_arsip.id_archive', '=', 'archive.id')
            ->leftjoin('users AS users_admin', 'peminjaman_arsip.id_admin', '=', 'users_admin.id')
            ->orderByDesc('update_peminjaman')
            ->skip(($page_pengambilan - 1) * 20)
            ->take(20)
            ->get();

        $peminjaman_selesai = DB::table('peminjaman_arsip')
            ->select('archive.*', 'peminjaman_arsip.update_at AS update_peminjaman', 'peminjaman_arsip.*', 'users.*', 'users_admin.name AS name_admin', 'peminjaman_arsip.id AS id_peminjaman')
            ->where('status', '=', 'Selesai')
            ->join('users', 'peminjaman_arsip.id_users', '=', 'users.id')
            ->join('archive', 'peminjaman_arsip.id_archive', '=', 'archive.id')
            ->leftjoin('users AS users_admin', 'peminjaman_arsip.id_admin', '=', 'users_admin.id')
            ->orderByDesc('update_peminjaman')
            ->skip(($page_selesai - 1) * 20)
            ->take(20)
            ->get();

        $peminjaman_dibatalkan = DB::table('peminjaman_arsip')
            ->select('archive.*', 'peminjaman_arsip.update_at AS update_peminjaman', 'peminjaman_arsip.*', 'users.*', 'users_admin.name AS name_admin', 'peminjaman_arsip.id AS id_peminjaman')
            ->where('status', '=', 'Dibatalkan Oleh Admin')
            ->orWhere('status', '=', 'Dibatalkan Oleh Pengguna')
            ->join('users', 'peminjaman_arsip.id_users', '=', 'users.id')
            ->join('archive', 'peminjaman_arsip.id_archive', '=', 'archive.id')
            ->leftjoin('users AS users_admin', 'peminjaman_arsip.id_admin', '=', 'users_admin.id')
            ->orderByDesc('update_peminjaman')
            ->skip(($page_batal - 1) * 20)
            ->take(20)
            ->get();

        $peminjaman = DB::table('peminjaman_arsip')
            ->select('archive.*', 'peminjaman_arsip.update_at AS update_peminjaman', 'peminjaman_arsip.*', 'users.*', 'users_admin.name AS name_admin', 'peminjaman_arsip.id AS id_peminjaman')
            ->join('users', 'peminjaman_arsip.id_users', '=', 'users.id')
            ->join('archive', 'peminjaman_arsip.id_archive', '=', 'archive.id')
            ->leftjoin('users AS users_admin', 'peminjaman_arsip.id_admin', '=', 'users_admin.id')
            ->get();

        $count_check_konfirmasi = DB::table('peminjaman_arsip')
            ->where('status', '=', 'Menunggu Konfirmasi')
            ->count();

        $count_check_unggahfile = DB::table('peminjaman_arsip')
            ->where('status', '=', 'Unggah Izin')
            ->orWhere('status', '=', 'File Izin Ditolak')
            ->count();

        $count_check_pengambilan = DB::table('peminjaman_arsip')
            ->where('status', '=', 'Pengambilan Arsip')
            ->count();

        $count_check_selesai = DB::table('peminjaman_arsip')
            ->where('status', '=', 'Selesai')
            ->count();

        $count_check_dibatalkan = DB::table('peminjaman_arsip')
            ->where('status', '=', 'Dibatalkan Oleh Admin')
            ->orwhere('status', '=', 'Dibatalkan Oleh Pengguna')
            ->count();

        $page_total_konfirmasi = $count_check_konfirmasi / 20;
        $page_total_unggah = $count_check_unggahfile / 20;
        $page_total_pengambilan = $count_check_pengambilan / 20;
        $page_total_selesai = $count_check_selesai / 20;
        $page_total_batal = $count_check_dibatalkan / 20;

        if ($search == 'default') {
            $event_cari = '1';
        } else {
            $event_cari = DB::table('peminjaman_arsip')
                ->select('archive.*', 'peminjaman_arsip.update_at AS update_peminjaman', 'peminjaman_arsip.*', 'users.*', 'users_admin.name AS name_admin', 'peminjaman_arsip.id AS id_peminjaman')
                ->join('users', 'peminjaman_arsip.id_users', '=', 'users.id')
                ->join('archive', 'peminjaman_arsip.id_archive', '=', 'archive.id')
                ->leftjoin('users AS users_admin', 'peminjaman_arsip.id_admin', '=', 'users_admin.id')
                ->where('kode_booking', '=', '#' . $search)
                ->get();

            $event_cari_check = DB::table('peminjaman_arsip')
                ->select('archive.*', 'peminjaman_arsip.update_at AS update_peminjaman', 'peminjaman_arsip.*', 'users.*', 'users_admin.name AS name_admin', 'peminjaman_arsip.id AS id_peminjaman')
                ->join('users', 'peminjaman_arsip.id_users', '=', 'users.id')
                ->join('archive', 'peminjaman_arsip.id_archive', '=', 'archive.id')
                ->leftjoin('users AS users_admin', 'peminjaman_arsip.id_admin', '=', 'users_admin.id')
                ->where('kode_booking', '=', '#' . $search)
                ->count();

            if ($event_cari_check == 0) {
                alert::warning('Kode Pemesanan Tidak Ditemukan', 'Pastikan Huruf Besar Dan Kecil Sesuai!');
                return redirect()->back();
            }
        }


        $data = (object) [
            'count_check_dibatalkan' => $count_check_dibatalkan,
            'count_check_selesai' =>  $count_check_selesai,
            'count_check_pengambilan' => $count_check_pengambilan,
            'count_check_unggahfile' => $count_check_unggahfile,
            'count_check_konfirmasi' => $count_check_konfirmasi,
            'sidebar' => "pelayanan",
            'peminjaman' => $peminjaman,
            'peminjaman_konfirmasi' => $peminjaman_konfirmasi,
            'peminjaman_unggahfile' => $peminjaman_unggahfile,
            'peminjaman_pengambilan' => $peminjaman_pengambilan,
            'peminjaman_selesai' => $peminjaman_selesai,
            'peminjaman_dibatalkan' => $peminjaman_dibatalkan,
            'breadcrumbsub' => 'Peminjaman Arsip',
            'breadcrumb' => 'Pelayanan',
            'page' => $page,
            'page_konfirmasi' => $page_konfirmasi,
            'page_unggah' => $page_unggah,
            'page_pengambilan' => $page_pengambilan,
            'page_selesai' => $page_selesai,
            'page_batal' => $page_batal,
            'search' => "",
            'tab_menu' => $tab,
            'event_cari' => $event_cari,
            'page_total_konfirmasi' => $page_total_konfirmasi,
            'page_total_unggah' => $page_total_unggah,
            'page_total_pengambilan' => $page_total_pengambilan,
            'page_total_selesai' => $page_total_selesai,
            'page_total_batal' => $page_total_batal
        ];

        return view('admin.peminjaman_arsip')->with('data', $data);
    }

    public function peminjaman_buku($page, $tab, $search)
    {
        if ($tab == 'konfirmasi') {
            $page_konfirmasi = $page;
            $page_berlangsung = 1;
            $page_pengambilan = 1;
            $page_selesai = 1;
            $page_batal = 1;
        } elseif ($tab == 'berlangsung') {
            $page_konfirmasi = 1;
            $page_berlangsung = $page;
            $page_pengambilan = 1;
            $page_selesai = 1;
            $page_batal = 1;
        } elseif ($tab == 'pengambilan') {
            $page_konfirmasi = 1;
            $page_berlangsung = 1;
            $page_pengambilan = $page;
            $page_selesai = 1;
            $page_batal = 1;
        } elseif ($tab == 'selesai') {
            $page_konfirmasi = 1;
            $page_berlangsung = 1;
            $page_pengambilan = 1;
            $page_selesai = $page;
            $page_batal = 1;
        } elseif ($tab == 'batal') {
            $page_konfirmasi = 1;
            $page_berlangsung = 1;
            $page_pengambilan = 1;
            $page_selesai = 1;
            $page_batal = $page;
        } else {
            $page_konfirmasi = 1;
            $page_berlangsung = 1;
            $page_pengambilan = 1;
            $page_selesai = 1;
            $page_batal = 1;
        }
        $peminjaman = DB::table('peminjaman_buku')
            ->select('*', 'peminjaman_buku.created_at AS created_at_peminjaman', 'peminjaman_buku.id AS id_peminjaman', 'peminjaman_buku.created_at AS tanggal_mulai')
            ->join('buku', 'buku.id', '=', 'peminjaman_buku.id_buku')
            ->leftJoin('users', 'users.id', '=', 'peminjaman_buku.id_users')
            ->orderByDesc('created_at_peminjaman')
            ->skip(($page - 1) * 1)
            ->take(1)
            ->get();

        $peminjaman_konfirmasi = DB::table('peminjaman_buku')
            ->select('*', 'peminjaman_buku.created_at AS created_at_peminjaman', 'peminjaman_buku.id AS id_peminjaman', 'peminjaman_buku.created_at AS tanggal_mulai')
            ->where('status', 'like', 'Menunggu Konfirmasi Admin')
            ->join('buku', 'buku.id', '=', 'peminjaman_buku.id_buku')
            ->leftJoin('users', 'users.id', '=', 'peminjaman_buku.id_users')
            ->orderByDesc('created_at_peminjaman')
            ->skip(($page_konfirmasi - 1) * 1)
            ->take(1)
            ->get();

        $peminjaman_berlangsung = DB::table('peminjaman_buku')
            ->select('*', 'peminjaman_buku.created_at AS created_at_peminjaman', 'peminjaman_buku.id AS id_peminjaman', 'peminjaman_buku.created_at AS tanggal_mulai')
            ->where('status', 'like', 'Peminjaman Berlangsung')
            ->join('buku', 'buku.id', '=', 'peminjaman_buku.id_buku')
            ->leftJoin('users', 'users.id', '=', 'peminjaman_buku.id_users')
            ->orderByDesc('created_at_peminjaman')
            ->skip(($page_berlangsung - 1) * 1)
            ->take(1)
            ->get();

        $peminjaman_pengambilan = DB::table('peminjaman_buku')
            ->select('*', 'peminjaman_buku.created_at AS created_at_peminjaman', 'peminjaman_buku.id AS id_peminjaman', 'peminjaman_buku.created_at AS tanggal_mulai')
            ->where('status', 'like', 'Pengambilan Buku')
            ->join('buku', 'buku.id', '=', 'peminjaman_buku.id_buku')
            ->leftJoin('users', 'users.id', '=', 'peminjaman_buku.id_users')
            ->orderByDesc('created_at_peminjaman')
            ->skip(($page_pengambilan - 1) * 1)
            ->take(1)
            ->get();

        $peminjaman_selesai = DB::table('peminjaman_buku')
            ->select('*', 'peminjaman_buku.created_at AS created_at_peminjaman', 'peminjaman_buku.id AS id_peminjaman', 'peminjaman_buku.created_at AS tanggal_mulai')
            ->where('status', 'like', 'Selesai')
            ->join('buku', 'buku.id', '=', 'peminjaman_buku.id_buku')
            ->leftJoin('users', 'users.id', '=', 'peminjaman_buku.id_users')
            ->orderByDesc('created_at_peminjaman')
            ->skip(($page_selesai - 1) * 1)
            ->take(1)
            ->get();

        $peminjaman_dibatalkan = DB::table('peminjaman_buku')
            ->select('*', 'peminjaman_buku.created_at AS created_at_peminjaman', 'peminjaman_buku.id AS id_peminjaman', 'peminjaman_buku.created_at AS tanggal_mulai')
            ->where('status', 'like', 'Dibatalkan Oleh Admin')
            ->orWhere('status', 'like', 'Dibatalkan Oleh Pengguna')
            ->join('buku', 'buku.id', '=', 'peminjaman_buku.id_buku')
            ->leftJoin('users', 'users.id', '=', 'peminjaman_buku.id_users')
            ->orderByDesc('created_at_peminjaman')
            ->skip(($page_batal - 1) * 1)
            ->take(1)
            ->get();

        $jumlah_konfirmasi = DB::table('peminjaman_buku')
            ->where('status', 'like', 'Menunggu Konfirmasi Admin')
            ->count();

        $jumlah_berlangsung = DB::table('peminjaman_buku')
            ->where('status', 'like', 'Peminjaman Berlangsung')
            ->count();

        $jumlah_pengambilan = DB::table('peminjaman_buku')
            ->where('status', 'like', 'Pengambilan Buku')
            ->count();

        $jumlah_selesai = DB::table('peminjaman_buku')
            ->where('status', 'like', 'Selesai')
            ->count();

        $jumlah_dibatalkan = DB::table('peminjaman_buku')
            ->where('status', 'like', 'Dibatalkan Oleh Admin')
            ->orWhere('status', 'like', 'Dibatalkan Oleh Pengguna')
            ->count();

        $page_total_konfirmasi = $jumlah_konfirmasi / 1;
        $page_total_berlangsung = $jumlah_berlangsung / 1;
        $page_total_pengambilan = $jumlah_pengambilan / 1;
        $page_total_selesai = $jumlah_selesai / 1;
        $page_total_batal = $jumlah_dibatalkan / 1;

        if ($search == 'default') {
            $event_cari = '1';
        } else {
            $event_cari = DB::table('peminjaman_buku')
                ->select('*', 'peminjaman_buku.created_at AS created_at_peminjaman', 'peminjaman_buku.id AS id_peminjaman', 'peminjaman_buku.created_at AS tanggal_mulai')
                ->join('buku', 'buku.id', '=', 'peminjaman_buku.id_buku')
                ->leftJoin('users', 'users.id', '=', 'peminjaman_buku.id_users')
                ->where('kode_booking', '=', '#' . $search)
                ->get();

            $event_cari_check = DB::table('peminjaman_buku')
                ->select('*', 'peminjaman_buku.created_at AS created_at_peminjaman', 'peminjaman_buku.id AS id_peminjaman', 'peminjaman_buku.created_at AS tanggal_mulai')
                ->join('buku', 'buku.id', '=', 'peminjaman_buku.id_buku')
                ->leftJoin('users', 'users.id', '=', 'peminjaman_buku.id_users')
                ->where('kode_booking', '=', '#' . $search)
                ->count();

            if ($event_cari_check == 0) {
                alert::warning('Kode Pemesanan Tidak Ditemukan', 'Pastikan Huruf Besar Dan Kecil Sesuai!');
                return redirect()->back();
            }
        }

        $data = (object) [
            'sidebar' => "pelayanan",
            'breadcrumbsub' => 'Peminjaman Buku',
            'breadcrumb' => 'Pelayanan',
            'peminjaman' => $peminjaman,
            'page' => $page,
            'search' => "",
            'tab' => $tab,
            'page_konfirmasi' => $page_konfirmasi,
            'page_berlangsung' => $page_berlangsung,
            'page_pengambilan' => $page_pengambilan,
            'page_selesai' => $page_selesai,
            'page_batal' => $page_batal,
            'jumlah_konfirmasi' => $jumlah_konfirmasi,
            'jumlah_berlangsung' => $jumlah_berlangsung,
            'jumlah_pengambilan' => $jumlah_pengambilan,
            'jumlah_selesai' => $jumlah_selesai,
            'jumlah_batal' => $jumlah_dibatalkan,
            'event_cari' => $event_cari,
            'peminjaman_konfirmasi' => $peminjaman_konfirmasi,
            'peminjaman_berlangsung' => $peminjaman_berlangsung,
            'peminjaman_pengambilan' => $peminjaman_pengambilan,
            'peminjaman_selesai' => $peminjaman_selesai,
            'peminjaman_dibatalkan' => $peminjaman_dibatalkan,
            'page_total_konfirmasi' => $page_total_konfirmasi,
            'page_total_berlangsung' => $page_total_berlangsung,
            'page_total_pengambilan' => $page_total_pengambilan,
            'page_total_selesai' => $page_total_selesai,
            'page_total_batal' => $page_total_batal

        ];

        return view('admin.peminjaman_buku')->with('data', $data);
    }

    public function user_all($page)
    {
        $users = DB::table('users')
            ->skip(($page - 1) * 20)
            ->take(20)
            ->get();

        $jumlah = DB::table('users')
            ->count();

        $data = (object) [
            'sidebar' => "user",
            'breadcrumb' => 'User',
            'breadcrumbsub' => '1',
            'user' => $users,
            'page' => $page,
            'search' => "",
            'jumlah' => $jumlah
        ];

        return view('admin.user')->with('data', $data);
    }

    public function archive($search, $page)
    {
        $archive = DB::table('archive')
            ->where('nomor_arsip', 'like', '%' . $search . '%')
            ->orWhere('nomor_surat', 'like', '%' . $search . '%')
            ->orWhere('kode_klasifikasi', 'like', '%' . $search . '%')
            ->skip(($page - 1) * 20)
            ->take(20)
            ->get();

        $jumlah = DB::table('archive')
            ->where('nomor_arsip', 'like', '%' . $search . '%')
            ->orWhere('nomor_surat', 'like', '%' . $search . '%')
            ->orWhere('kode_klasifikasi', 'like', '%' . $search . '%')
            ->count();

        $data = (object) [
            'sidebar' => 'pelayanan',
            'breadcrumb' => 'Pelayanan',
            'breadcrumbsub' => 'Data Arsip',
            'archive' => $archive,
            'page' => $page,
            'search' => $search,
            'jumlah' => $jumlah
        ];

        return view('admin.archive')->with('data', $data);
    }

    public function e_book($search, $page)
    {
        $buku = DB::table('buku')
            ->select('buku.*', 'kategori_buku.id AS id_kategori', 'kategori_buku.kategory AS kategory')
            ->leftjoin('kategori_buku', 'buku.id_kategori', '=', 'kategori_buku.id')
            ->where('judul', 'like', '%' . $search . '%')
            ->orWhere('penulis', 'like', '%' . $search . '%')
            ->orWhere('penerbit', 'like', '%' . $search . '%')
            ->orWhere('tahun_terbit', '=',  $search)
            ->get();

        $jumlah = DB::table('buku')
            ->select('buku.*', 'kategori_buku.id AS id_kategori', 'kategori_buku.kategory AS kategory')
            ->leftjoin('kategori_buku', 'buku.id_kategori', '=', 'kategori_buku.id')
            ->where('judul', 'like', '%' . $search . '%')
            ->orWhere('penulis', 'like', '%' . $search . '%')
            ->orWhere('penerbit', 'like', '%' . $search . '%')
            ->orWhere('tahun_terbit', '=',  $search)
            ->count();

        $kategori = DB::table('kategori_buku')
            ->get();

        $tag = DB::table('tag_buku')
            ->get();

        $data = (object) [
            'sidebar' => 'pelayanan',
            'breadcrumb' => 'Pelayanan',
            'breadcrumbsub' => 'Data Buku',
            'kategori' => $kategori,
            'buku' => $buku,
            'page' => $page,
            'search' => $search,
            'jumlah' => $jumlah
        ];

        return view('admin.buku')->with('data', $data);
    }

    public function user($search, $page)
    {
        $users = DB::table('users')
            ->where('name', 'like', '%' . $search . '%')
            ->orWhere('ktp_number', 'like', '%' . $search . '%')
            ->orWhere('email', 'like', '%' . $search . '%')
            ->skip(($page - 1) * 20)
            ->take(20)
            ->get();

        $jumlah = DB::table('users')
            ->where('name', 'like', '%' . $search . '%')
            ->orWhere('ktp_number', 'like', '%' . $search . '%')
            ->orWhere('email', 'like', '%' . $search . '%')
            ->count();

        $data = (object) [
            'sidebar' => 'user',
            'breadcrumb' => 'User',
            'user' => $users,
            'page' => $page,
            'search' => $search,
            'jumlah' => $jumlah
        ];

        return view('admin.user')->with('data', $data);
    }

    public function logout_admin()
    {

        Auth::logout();
        return redirect('/login_admin_page');
    }

    public function login_check(Request $request)
    {

        $data = [
            'email'     => $request->email,
            'password'  => $request->password
        ];

        Auth::attempt($data);

        if (Auth::check()) {
            $data = (object) ['menu' => 'search'];
            return redirect('/admin/menu');
        } else {
            return redirect()->back()->with('fail', 'gagal');
        }
    }

    public function tambah_archive_baru(Request $request)
    {
        $messages = [
            'required' => ':attribute wajib diisi',
            'numeric' => ':attribute hanya boleh pakai angka'
        ];

        $this->validate($request, [
            'nomor_arsip' => 'required',
            'nomor_surat' => 'required',
            'nama_pencipta' => 'required',
            'petugas_registrasi' => 'required',
            'kode_klasifikasi' => 'required',
            'jumlah_arsip' => 'required|numeric',
            'type' => 'required',
            'keterangan' => 'required',
            'file' => 'required'
        ], $messages);

        $user = Auth::user();

        $file = $request->file('file');
        $filename = time() . "_" . $request->nomor_arsip . "." . $request->file->getClientOriginalExtension();
        $file->move(base_path('\storage\app\public\file_arsip'), $filename);

        DB::table('archive')->insert([
            'nomor_arsip' => $request->nomor_arsip,
            'nomor_surat' => $request->nomor_surat,
            'nama_pencipta' => $request->nama_pencipta,
            'petugas_registrasi' => $request->petugas_registrasi,
            'kode_klasifikasi' => $request->kode_klasifikasi,
            'jumlah_arsip' => $request->jumlah_arsip,
            'type' => $request->type,
            'keterangan' => $request->keterangan,
            'file' => $filename,
            'created_by' => $user->id
        ]);


        return redirect()->back()->with('success', 'berhasil');
    }

    public function getDownload(Request $request)
    {
        $file = $request->query("file");
        $file_location = public_path('storage\file_arsip\\' . $file);
        return response()->download($file_location);
    }

    public function delete_arsip(Request $request)
    {
        $id = $request->query("id");
        $query = DB::table('archive')
            ->where('id', '=', $id);

        $filename = $query->first()->file;

        File::delete(public_path('storage\file_arsip\\' . $filename));
        $query->delete();

        Alert::success('Berhasil', 'Data berhasil dihapus');
        return redirect()->back();
    }

    public function update_arsip(Request $request)
    {
        $id = $request->id;
        $archive = DB::table('archive')
            ->where('id', '=', $id);

        $user = Auth::user();
        if (empty($request->file)) {
            $archive->update([
                'nomor_arsip' => $request->nomor_arsip,
                'nomor_surat' => $request->nomor_surat,
                'nama_pencipta' => $request->nama_pencipta,
                'petugas_registrasi' => $request->petugas_registrasi,
                'kode_klasifikasi' => $request->kode_klasifikasi,
                'jumlah_arsip' => $request->jumlah_arsip,
                'type' => $request->type,
                'keterangan' => $request->keterangan,
                'updated_by' => $user->id
            ]);
        } else {
            File::delete(public_path('storage\file_arsip\\' . $request->old_file));
            $file = $request->file('file');
            $filename = time() . "_" . $request->nomor_arsip . "." . $request->file->getClientOriginalExtension();
            $file->move(base_path('\storage\app\public\file_arsip'), $filename);

            $archive->update([
                'nomor_arsip' => $request->nomor_arsip,
                'nomor_surat' => $request->nomor_surat,
                'nama_pencipta' => $request->nama_pencipta,
                'petugas_registrasi' => $request->petugas_registrasi,
                'kode_klasifikasi' => $request->kode_klasifikasi,
                'jumlah_arsip' => $request->jumlah_arsip,
                'type' => $request->type,
                'file' => $filename,
                'keterangan' => $request->keterangan,
                'updated_by' => $user->id
            ]);
        }
        return redirect()->back()->with('success', 'berhasil');
    }

    public function konfirmasi_peminjaman_arsip(Request $request)
    {
        $id = $request->id;
        $peminjaman = DB::table('peminjaman_arsip')
            ->where('id', '=', $id);
        $konfirm = $request->konfirm;

        if ($konfirm == 1) {
            $status = 'Pengambilan Arsip';
        } elseif ($konfirm == 2) {
            $status = 'Dibatalkan Oleh Admin';
        } elseif ($konfirm == 3) {
            $status = 'File Izin Ditolak';
        };

        $peminjaman
            ->update([
                'status' => $status,
                'start_at' => Carbon::today(),
                'expired_at' => Carbon::today()->addDay(6),
                'komentar' => $request->komentar,
                'id_admin' => $request->id_admin,
                'update_at' => Carbon::now()->toDateTimeString()
            ]);

        Alert::success('Berhasil', 'Data Peminjaman Pengguna Berhasil Dikonfirmasi');
        if ($request->tab == 'konfirmasi') {
            return redirect('admin/menu/peminjaman_arsip/' . $request->tab . '/1/default');
        } else {
            return redirect()->back();
        }
    }

    public function konfirmasi_peminjaman_buku(Request $request)
    {
        $id = $request->id;
        $peminjaman = DB::table('peminjaman_buku')
            ->where('id', '=', $id);
        $konfirm = $request->konfirm;

        if ($konfirm == 1) {
            $status = 'Pengambilan Buku';
            $peminjaman
                ->update([
                    'status' => $status,
                    'batas_pengambilan' => Carbon::today()->addDay(6),
                    'komentar' => $request->komentar,
                    'id_admin' => $request->id_admin,
                    'update_at' => Carbon::now()->toDateTimeString()
                ]);
        } elseif ($konfirm == 2) {
            $status = 'Dibatalkan Oleh Admin';
            $peminjaman
                ->update([
                    'status' => $status,
                    'komentar' => $request->komentar,
                    'id_admin' => $request->id_admin,
                    'update_at' => Carbon::now()->toDateTimeString()
                ]);
        };

        Alert::success('Berhasil', 'Data Peminjaman Pengguna Berhasil Dikonfirmasi');
        if ($request->tab == 'konfirmasi') {
            return redirect('admin/menu/peminjaman_buku/1/'.$request->tab.'/default');
        } else {
            return redirect()->back();
        }
    }

    public function konfirmasi_peminjaman_buku_by_id($id, $konfirm)
    {
        $peminjaman = DB::table('peminjaman_buku')
            ->where('id', '=', $id);

        if ($konfirm == 1) {
            $status = 'Pengambilan Buku';
            $peminjaman
                ->update([
                    'status' => $status,
                    'start_at' => Carbon::today(),
                    'expired_at' => Carbon::today()->addDay(6),
                    'update_at' => Carbon::now()->toDateTimeString()
                ]);
        } elseif ($konfirm == 2) {
            $status = 'Selesai';
            $peminjaman
                ->update([
                    'status' => $status,
                    'return_at' => Carbon::today(),
                    'update_at' => Carbon::now()->toDateTimeString()
                ]);
        };
    }

    public function konfirmasi_peminjaman_arsip_selesai($id, $tab)
    {
        DB::table('peminjaman_arsip')
            ->where('id', '=', $id)
            ->update([
                'status' => 'Selesai',
                'update_at' => Carbon::now()->toDateTimeString()
            ]);

        alert::success('Berhasil', 'Pengambilan Arsip Berhasil Dikonfirmasi!');
        if ($tab == 'pengambilan') {
            return redirect('admin/menu/peminjaman_arsip/' . $tab . '/1/default');
        } else {
            return redirect()->back();
        }
    }

    public function konfirmasi_peminjaman_arsip_batal($id, $tab)
    {
        DB::table('peminjaman_arsip')
            ->where('id', '=', $id)
            ->update([
                'status' => 'Dibatalkan Oleh Admin',
                'update_at' => Carbon::now()->toDateTimeString()
            ]);

        alert::success('Berhasil', 'Peminjaman Arsip Berhasil Dibatalkan!');
        if ($tab == 'konfirmasi' || $tab == 'unggah' || $tab == 'pengambilan') {
            return redirect('admin/menu/peminjaman_arsip/' . $tab . '/1/default');
        } else {
            return redirect()->back();
        }
    }

    public function konfirmasi_peminjaman_buku_batal($id, $tab)
    {
        DB::table('peminjaman_buku')
            ->where('id', '=', $id)
            ->update([
                'status' => 'Dibatalkan Oleh Admin',
                'update_at' => Carbon::now()->toDateTimeString()
            ]);

        alert::success('Berhasil', 'Peminjaman Buku Berhasil Dibatalkan!');
        if ($tab == 'konfirmasi') {
            return redirect('admin/menu/peminjaman_buku/1/'.$tab.'/default');
        } else {
            return redirect()->back();
        }
    }

    public function konfirmasi_hapus_peminjaman_arsip(Request $request)
    {
        File::delete(public_path('storage\bukti_izin\\' . $request->file));
        DB::table('peminjaman_arsip')
            ->where('id', '=', $request->id)
            ->delete();

        alert::success('Berhasil', 'Data Peminjaman Arsip Berhasil Dihapus!');
        if ($request->tab == 'selesai' || $request->tab == 'batal') {
            return redirect('admin/menu/peminjaman_arsip/' . $request->tab . '/1/default');
        } else {
            return redirect('admin/menu/peminjaman_arsip/1/1/default');
        }
    }

    public function konfirmasi_selesai(Request $request)
    {
        $konfirm = DB::table('peminjaman_buku')
            ->where('id', '=', $request->id);

        $konfirm
            ->update([
                'status' => 'Selesai',
                'return_at' => Carbon::today(),
                'denda' => $request->denda,
                'update_at' => Carbon::now()->toDateTimeString()
            ]);

        DB::table('buku')
            ->where('id', '=', $request->id_buku)
            ->update([
                'stock_buku' => DB::raw('stock_buku + 1')
            ]);

        Alert::success('Berhasil', 'Status Peminjaman Berhasil Diubah');
        if ($request->tab == 'berlangsung') {
            return redirect('admin/menu/peminjaman_buku/1/'.$request->tab.'/default');
        } else {
            return redirect()->back();
        }
    }

    public function hapus_peminjaman($id, $tab)
    {
        DB::table('peminjaman_buku')
            ->where('id', '=', $id)
            ->delete();

        alert::success('Berhasil', 'Data Peminjaman Berhasil Dihapus');
        if ($tab == 'selesai' || $tab == 'batal') {
            return redirect('admin/menu/peminjaman_buku/1/'.$tab.'/default');
        } else {
            return redirect('admin/menu/peminjaman_buku/1/1/default');
        }
    }

    public function pengambilan_buku($id, $tab)
    {
        $query = DB::table('peminjaman_buku')
            ->where('id', '=', $id);

        $query
            ->update([
                'status' => 'Peminjaman Berlangsung',
                'start_at' => Carbon::today(),
                'expired_at' => Carbon::today()->addDays(6),
                'update_at' => Carbon::now()->toDateTimeString()
            ]);

        alert::success('Berhasil', 'Pengambilan Buku Berhasil Dikonformasi');
        if ($tab == 'pengambilan') {
            return redirect('admin/menu/peminjaman_buku/1/'.$tab.'/default');
        } else {
            return redirect()->back();
        }
    }

    public function contact_us_admin()
    {
        $contact_data = DB::table('contact_us')
            ->get();

        $data = (object) [
            'sidebar' => 'contact_us',
            'breadcrumb' => 'Contact Us',
            'breadcrumbsub' => '1',
            'contact_data' => $contact_data
        ];


        return view('admin.contact_us')->with('data', $data);
    }

    public function edit_content(Request $request)
    {
        File::delete(public_path('storage\admin_conten\\' . $request->old_file));
        $path = $request->file('file');
        $pathname = time() . "_" . $request->id . "." . $request->file->getClientOriginalExtension();
        $path->move(public_path('storage\admin_conten'), $pathname);

        DB::table('content_home')
            ->where('id', '=', $request->id)
            ->update([
                'path' => $pathname,
                'id_admin' => $request->id_admin,
                'update_at' => Carbon::now()->toDateTimeString()
            ]);

        alert::success('Berhasil', 'Data Konten Berhasil Diubah');
        return redirect()->back();
    }

    public function konten_status($id, $status)
    {
        $query = DB::table('content_home')
            ->where('id', '=', $id);

        if ($status == 1) {
            $query
                ->update([
                    'status' => '0',
                    'update_at' => Carbon::now()->toDateTimeString()
                ]);
            alert::success('Berhasil', 'Konten Berhasil Dinonaktifkan');
        } else {
            $query
                ->update([
                    'status' => '1',
                    'update_at' => Carbon::now()->toDateTimeString()
                ]);
            alert::success('Berhasil', 'Konten Berhasil Diaktifkan');
        }

        return redirect()->back();
    }

    public function artikel_admin()
    {
        $artikel = DB::table('artikel')
            ->skip((1 - 1) * 20)
            ->take(20)
            ->get();

        $data = (object) [
            'sidebar' => 'infoterkini',
            'breadcrumb' => 'Info Terkini',
            'breadcrumbsub' => 'Berita',
            'artikel' => $artikel
        ];


        return view('admin.artikel')->with('data', $data);
    }

    public function artikel_admin_tambah_page()
    {
        $data = (object) [
            'sidebar' => 'infoterkini',
            'breadcrumb' => 'Info Terkini',
            'breadcrumbsub' => 'Berita'
        ];

        return view('admin.tambah_artikel')->with('data', $data);
    }

    public function tambah_artikel(Request $request)
    {
        $path = $request->file('file');
        $pathname = "IMG_" . time() . "_" . "." . $request->file->getClientOriginalExtension();
        $path->move(public_path('storage\gambar_artikel'), $pathname);

        DB::table('artikel')
            ->insert([
                'judul' => $request->judul,
                'penulis' => $request->penulis,
                'tanggal' => $request->tanggal,
                'gambar' => $pathname,
                'content' => $request->konten
            ]);

        alert::success('Berhasil', 'data berhasil diubah!');
        return redirect()->back();
    }

    public function update_page_artikel($id)
    {
        $artikel = DB::table('artikel')
            ->where('id', '=', $id)
            ->get();

        $data = (object) [
            'sidebar' => 'infoterkini',
            'breadcrumb' => 'Info Terkini',
            'breadcrumbsub' => 'Berita',
            'artikel' => $artikel
        ];

        return view('admin.edit_artikel')->with('data', $data);
    }

    public function update_artikel(Request $request)
    {
        if (empty($request->file)) {
            DB::table('artikel')
                ->where('id', '=', $request->id)
                ->update([
                    'judul' => $request->judul,
                    'penulis' => $request->penulis,
                    'tanggal' => $request->tanggal,
                    'content' => $request->konten
                ]);
        } else {
            File::delete(public_path('storage\gambar_artikel\\' . $request->old_pict));
            $path = $request->file('file');
            $pathname = "IMG_" . time() . "_" . "." . $request->file->getClientOriginalExtension();
            $path->move(public_path('storage\gambar_artikel'), $pathname);

            DB::table('artikel')
                ->where('id', '=', $request->id)
                ->update([
                    'judul' => $request->judul,
                    'penulis' => $request->penulis,
                    'tanggal' => $request->tanggal,
                    'content' => $request->konten,
                    'gambar' => $pathname
                ]);
        }

        alert::success('Berhasil', 'data berhasil diubah!');
        return redirect()->back();
    }

    public function foto_video($page, $tab)
    {
        if ($tab == 2) {
            $tab = 'foto';
            $page_video = 1;
            $video = DB::table('video')
                ->skip(($page_video - 1) * 2)
                ->take(2)
                ->get();
        } else {
            $page_video = $page;
            $video = DB::table('video')
                ->skip(($page - 1) * 2)
                ->take(2)
                ->get();
        }
        $video_jumlah = DB::table('video')
            ->count();

        $page_video_jumlah = $video_jumlah / 2;

        if ($tab == 'video') {
            $page_foto = 1;
            $foto = DB::table('foto')
                ->skip(($page_foto - 1) * 8)
                ->take(8)
                ->get();
        } else {
            $page_foto = $page;
            $foto = DB::table('foto')
                ->skip(($page - 1) * 8)
                ->take(8)
                ->get();
        }

        $foto_jumlah = DB::table('foto')
            ->count();

        $page_foto_jumlah = $foto_jumlah / 8;

        $data = (object) [
            'sidebar' => "infoterkini",
            'breadcrumbsub' => 'Foto Dan Video',
            'breadcrumb' => 'Info Terkini',
            'tab' => $tab,
            'page' => $page,
            'search' => "",
            'foto' => $foto,
            'foto_jumlah' => $page_foto_jumlah,
            'video' => $video,
            'video_jumlah' => $page_video_jumlah,
            'page_foto' => $page_foto,
            'page_video' => $page_video
        ];

        return view('admin.foto_video')->with('data', $data);
    }

    public function tambah_foto(Request $request)
    {
        $path = $request->file('file');
        $pathname = "IMG_" . time() . "_Dinas" . "." . $request->file->getClientOriginalExtension();
        $path->move(public_path('storage\foto_video\foto'), $pathname);

        DB::table('foto')
            ->insert([
                'judul' => $request->judul,
                'path' => $pathname
            ]);

        alert::success('Berhasil', 'Foto berhasil ditambahkan');
        return redirect()->back();
    }

    public function edit_foto(Request $request)
    {
        $query = DB::table('foto')
            ->where('id', '=', $request->id);

        if (empty($request->file)) {
            $query
                ->update([
                    'judul' => $request->judul
                ]);
        } else {
            File::delete(public_path('storage\foto_video\foto\\' . $request->old_path));
            $path = $request->file('file');
            $pathname = "IMG_" . time() . "_Dinas" . "." . $request->file->getClientOriginalExtension();
            $path->move(public_path('storage\foto_video\foto'), $pathname);

            $query
                ->update([
                    'judul' => $request->judul,
                    'path' => $pathname
                ]);
        }

        alert::success('Berhasil', 'Data foto berhasil diperbarui');
        return redirect()->back();
    }

    public function hapus_foto($id)
    {
        $query = DB::table('foto')
            ->where('id', '=', $id)
            ->get();

        File::delete(public_path('storage\foto_video\foto\\' . $query['0']->path));

        DB::table('foto')
            ->where('id', '=', $id)
            ->delete();

        alert::success('Berhasil', 'Data foto berhasil dihapus');
        return redirect()->back();
    }

    public function tambah_video(Request $request)
    {
        DB::table('video')
            ->insert([
                'link' => 'https://www.youtube.com/embed/' . $request->link
            ]);

        $tab = 'video';

        alert::success('Berhasil', 'Link video berhasil ditambah');

        return redirect('/admin/menu/foto_video/1/' . $tab);
    }

    public function edit_video(Request $request)
    {

        DB::table('video')
            ->where('id', '=', $request->id)
            ->update([
                'link' => 'https://www.youtube.com/embed/' . $request->link
            ]);

        $tab = 'video';

        return redirect('/admin/menu/foto_video/' . $request->page . '/' . $tab);
    }

    public function hapus_video($page_video, $id)
    {
        DB::table('video')
            ->where('id', '=', $id)
            ->delete();

        $tab = 'video';

        return redirect('/admin/menu/foto_video/' . $page_video . '/' . $tab);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
