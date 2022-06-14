<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
// setlocale(LC_TIME, 'Indonesia');

class homeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function home_page()
    {
        if (Auth::check()) {
            $user = Auth::user();

            $data = (object) [
                'user' => $user,
                'menu' => 'beranda',
                'submenu' => 'none',
            ];

            return view('client.home')->with('data', $data);
        } else {
            $data = (object) [
                'menu' => 'beranda',
                'submenu' => 'none',
            ];
            return view('client.home')->with('data', $data);
        }
    }

    public function search_home($submenu)
    {
        $user = Auth::user();
        $data = (object) [
            'menu' => 'layanan',
            'user' => $user,
            'submenu' => $submenu
        ];

        return view('client.archive')->with('data', $data);
    }

    public function peminjaman_page()
    {
        if (Auth::check()) {
            $user = Auth::user();
            $data_peminjaman = DB::table('archive')
                ->join('peminjaman_arsip', 'archive.id', '=', 'peminjaman_arsip.id_archive')
                ->where('id_users', '=', $user->id)
                ->get();

            $data = (object) [
                'breadcrumb' => 'Data Peminjaman Arsip Pengguna',
                'submenu' => 'peminjaman arsip',
                'menu' => 'layanan',
                'user' => $user,
                'data_arsip' => $data_peminjaman
            ];

            return view('client.peminjaman')->with('data', $data);
        } else {
            Alert::warning('Perhatian', 'Anda Harus Masuk Terlebih Dahulu');
            return redirect()->back();
        }
    }

    public function peminjaman_page_buku()
    {
        if (Auth::check()) {
            $user = Auth::user();
            $peminjaman = DB::table('peminjaman_buku')
            ->select('*','peminjaman_buku.created_at AS created_at_peminjaman','peminjaman_buku.id AS id_peminjaman', 'buku.id AS id_buku')
            ->join('buku', 'buku.id', '=', 'peminjaman_buku.id_buku')
            ->orderByDesc('created_at_peminjaman')
            ->get();

            $data = (object) [
                'breadcrumb' => 'Data Peminjaman Buku Pengguna',
                'submenu' => 'peminjaman buku',
                'menu' => 'layanan',
                'user' => $user,
                'data_buku' => $peminjaman
            ];

            return view('client.peminjaman_buku')->with('data', $data);
        } else {
            Alert::warning('Perhatian', 'Anda Harus Masuk Terlebih Dahulu');
            return redirect()->back();
        }
    }

    public function archive_main(Request $request)
    {
        $search = $request->search;
        if ($search == "") {
            return redirect('all_archive/1/');
        } else {
            return redirect('archive/' . $search . '/1');
        }
    }

    public function buku_main(Request $request)
    {
        $search = $request->search;
        if ($search == "") {
            return redirect('all_book/1/');
        } else {
            return redirect('book/' . $search . '/1');
        }
    }

    public function archive_all($page)
    {
        $archive = DB::table('archive')
            ->get();

        $user = Auth::user();
        $jumlah = $archive->count();

        $data = (object) [
            'search' => "",
            'breadcrumb' => 'Lihat Semua Dokumen',
            'menu' => 'layanan',
            'submenu' => 'pencarian arsip',
            'user' => $user,
            'page' => $page,
            'archive' => $archive,
            'jumlah' => $jumlah
        ];

        return view('client.search')->with('data', $data);
    }

    public function book_all($page)
    {
        $archive = DB::table('buku')
            ->get();

        $user = Auth::user();
        $jumlah = $archive->count();

        $data = (object) [
            'search' => "",
            'breadcrumb' => 'Lihat Semua Buku',
            'menu' => 'layanan',
            'submenu' => 'pencarian buku',
            'user' => $user,
            'page' => $page,
            'archive' => $archive,
            'jumlah' => $jumlah
        ];

        return view('client.search')->with('data', $data);
    }



    public function unggah_file(Request $request)
    {
        if ($request->file('file') == NULL) {
            Alert::warning('Unggah File Gagal!', 'Form File Tidak Boleh Kosong');
            return redirect()->back();
        } else {
            $query = DB::table('peminjaman_arsip')
                ->where('id', '=', $request->id);

            $file = $request->file('file');
            $filename = time() . "_File Arsip." . $request->file->getClientOriginalExtension();
            $file->move(base_path('\storage\app\public\bukti_izin'), $filename);

            $query->update([
                'file_izin' => $filename,
                'status' => 'Menunggu Konfirmasi'
            ]);

            Alert::success('Berhasil!', 'File Berhasil Diunggah');
            return redirect()->back();
        }
    }

    public function search($search, $page)
    {
        $archive = DB::table('archive')
            ->where('nomor_surat', 'like', '%' . $search . '%')
            ->orWhere('nomor_arsip', 'like', '%' . $search . '%')
            ->get();

        $jumlah = $archive->count();
        $user = Auth::user();
        $data = (object) [
            'search' => $search,
            'breadcrumb' => 'Penelusuran ' . $search,
            'menu' => 'layanan',
            'submenu' => 'pencarian arsip',
            'page' => $page,
            'archive' => $archive,
            'jumlah' => $jumlah,
            'user' => $user
        ];

        return view('client.search')->with('data', $data);
    }

    public function book_search($search, $page)
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

        $user = Auth::user();
        $data = (object) [
            'search' => $search,
            'breadcrumb' => 'Penelusuran ' . $search,
            'menu' => 'layanan',
            'submenu' => 'pencarian buku',
            'page' => $page,
            'buku' => $buku,
            'jumlah' => $jumlah,
            'user' => $user
        ];

        return view('client.buku_search')->with('data', $data);
    }

    public function detail_buku($id)
    {
        $user = Auth::user();
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

        $data = (object) [
            'breadcrumb' => 'Penelusuran ',
            'menu' => 'layanan',
            'submenu' => 'pencarian buku',
            'user' => $user,
            'buku' => $buku,
            'tag_buku' => $tag_buku,
            'tag_buku_jumlah' => $tag_buku_jumlah
        ];
        
        return view('client.detail_buku_user')->with('data', $data);
    }

    public function profile()
    {
        $user = Auth::user();

        $user->birth_date = Carbon::parse($user->birth_date)->translatedFormat('d F Y');
        $user->join_at = Carbon::parse($user->created_at)->translatedFormat('d F Y');

        $data = (object) [
            'breadcrumb' => 'Profil Pengguna',
            'menu' => 'profile',
            'submenu' => 'settings',
            'user' => $user
        ];

        return view('client.profile')->with('data', $data);
    }

    public function update_profile(Request $request)
    {

        $id = Auth::id();
        $user = User::findOrFail($id);

        $user->phone_number = $request->phone_number;
        $user->address = $request->address;
        $user->email = $request->email;

        $user->save();

        return redirect()->back()->with('success', 'berhasil');
    }

    public function update_password(Request $request)
    {

        $id = Auth::id();
        $user = User::findOrFail($id);

        $messages = [
            'required' => ':attribute wajib diisi',
            'min' => ':attribute harus punya minimal :min karakter',
            'max' => ':attribute harus punya maksimal :max karakter',
            'confirmed' => ':attribute tidak sesuai',
            'regex' => ':attribute harus ada karakter angka',
            'pwdvalidation' => 'harus sesuai dengan :attribute'
        ];

        $this->validate($request, [
            'password_old' => 'required|min:8|max:32|pwdvalidation',
            'password_new' => 'required|confirmed|min:8|max:32|regex:/[0-9]/'
        ], $messages);

        $user->password = Hash::make($request->password_new);

        $user->save();

        return redirect()->back()->with('success', 'berhasil');
    }

    public function register()
    {
        $data = (object) ['breadcrumb' => 'Pendaftaran', 'menu' => 'register'];

        return view('client.register')->with('data', $data);
    }

    public function login()
    {

        $data = (object) [
            'breadcrumb' => 'Login Pengguna',
            'menu' => 'login',
            'submenu' => 'masuk'
        ];
        return view('client.login')->with('data', $data);
    }

    public function login_check(Request $request)
    {

        $data = [
            'email'     => $request->email,
            'password'  => $request->password
        ];

        Auth::attempt($data);
        // dd(Auth::user());
        if (Auth::check()) {
            $data = (object) ['menu' => 'search'];
            return redirect('home');
        } else {
            $data = (object) ['breadcrumb' => 'Masuk', 'menu' => 'login'];
            return redirect()->back()->with('fail', 'gagal');
        }
    }

    public function logout()
    {

        Auth::logout();
        return redirect('/masuk');
    }

    public function batal_pinjam_user($id)
    {
        $batal_pinjam = DB::table('peminjaman_arsip')
            ->where('id', '=', $id);

        $batal_pinjam
            ->update([
                'status' => 'Dibatalkan Oleh Pengguna'
            ]);

        alert::success('Berhasil', 'Peminjaman Berhasil Dibatalkan');
        return redirect()->back();
    }

    public function batal_pinjam_buku_user($id)
    {
        $batal_pinjam = DB::table('peminjaman_buku')
            ->where('id', '=', $id);

        $batal_pinjam
        ->update([
            'status' => 'Dibatalkan Oleh Pengguna'
        ]);

        alert::success('Berhasil', 'Peminjaman Berhasil Dibatalkan');
        return redirect()->back();
        
    }

    public function peminjaman_arsip(Request $request)
    {
        $check =  DB::table('peminjaman_arsip')
            ->where('id_users', '=', $request->id_users)
            ->where('id_archive', '=', $request->id_archive)
            ->count();

        if ($request->type == '1') {
            $status = "Unggah Izin";
        } else {
            $status = "Menunggu Konfirmasi";
        }

        $biaya = $request->jumlah * 200;

        if ($check > 0) {
            Alert::warning('Peminjaman Gagal!', 'Anda Telah Meminjam Arsip Ini');
            return redirect()->back();
        } else {
            DB::table('peminjaman_arsip')->insert([
                'id_users' => $request->id_users,
                'id_archive' => $request->id_archive,
                'status' => $status,
                'biaya' => $biaya,
                'created_at' => Carbon::now()
            ]);
            Alert::success('Berhasil!', 'Peminjaman Berhasil Dilakukan');
            return redirect()->back();
        }
    }

    public function peminjaman_buku(Request $request)
    {
        $check =  DB::table('peminjaman_buku')
            ->where('id_users', '=', $request->id_users)
            ->where('id_buku', '=', $request->id_buku)
            ->where('status', '!=', 'Dibatalkan Oleh Admin')
            ->Where('status', '!=', 'Dibatalkan Oleh Pengguna')
            ->Where('status', '!=', 'Selesai')
            ->count();


        if ($check > 0) {
            Alert::warning('Peminjaman Buku Ini Sedang Berlangsung!', 'Silahkan Selesaikan Peminjaman Di Halaman Peminjaman!');
            return redirect()->back();
        } else 
        {
            do {
                $booking = '#'.Str::random(5);
            }
            while (DB::table('peminjaman_buku')
            ->where('kode_booking','=',$booking)
            ->first());

            DB::table('peminjaman_buku')->insert([
                'kode_booking' => '#'.Str::random(5),
                'id_users' => $request->id_users,
                'id_buku' => $request->id_buku,
                'status' => 'Menunggu Konfirmasi Admin'
                
            ]);
            Alert::success('Berhasil!', 'Peminjaman Berhasil Dilakukan');
            return redirect()->back();
        }
        
    }

    public function tambah_akun(Request $request)
    {
        $messages = [
            'required' => ':attribute wajib diisi',
            'min' => ':attribute harus punya minimal :min karakter',
            'max' => ':attribute harus punya maksimal :max karakter',
            'alpha' => ':attribute hanya boleh pakai huruf',
            'numeric' => ':attribute hanya boleh pakai angka',
            'date' => 'format tanggal salah',
            'email' => 'format email salah',
            'unique' => ':attribute sudah dipakai',
            'confirmed' => ':attribute tidak sesuai',
            'name.regex' => ':attribute hanya boleh pakai huruf',
            'password.regex' => ':attribute harus ada karakter angka',
            'digits' => ':attribute harus sepanjang :digits karakter'
        ];

        $this->validate($request, [
            'name' => 'required|regex:/^[\pL\s\-]+$/u',
            'ktp_number' => 'required|numeric|unique:users|digits:17',
            'phone_number' => 'required|numeric',
            'sex' => 'required',
            'birth_city' => 'required',
            'birth_date' => 'required|date',
            'address' => 'required',
            'email' => 'required|unique:users|email',
            'password' => 'required|confirmed|min:8|max:32|regex:/[0-9]/'
        ], $messages);

        DB::table('users')->insert([
            'name' => $request->name,
            'ktp_number' => $request->ktp_number,
            'phone_number' => $request->phone_number,
            'sex' => $request->get('sex'),
            'birth_city' => $request->birth_city,
            'birth_date' => $request->birth_date,
            'address' => $request->address,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'admin' => 0,
            'created_at' => Carbon::now()
        ]);

        return redirect()->back()->with('success', 'berhasil');
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
