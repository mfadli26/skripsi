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

use App\Models\User;

class adminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $data = (object) ['sidebar' => 'home', 'breadcrumb' => 'Dashboard'];

        return view('admin.admin')->with('data', $data);
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

    public function archive_all($page)
    {
        $archive = DB::table('archive')
            ->skip(($page - 1) * 20)
            ->take(20)
            ->get();

        $jumlah = DB::table('archive')
            ->count();

        $data = (object) ['sidebar' => "archive", 'breadcrumb' => 'archive', 'archive' => $archive, 'page' => $page, 'search' => "", 'jumlah' => $jumlah];

        return view('admin.archive')->with('data', $data);
    }

    public function user_all($page)
    {
        $users = DB::table('users')
            ->skip(($page - 1) * 20)
            ->take(20)
            ->get();

        $jumlah = DB::table('users')
            ->count();

        $data = (object) ['sidebar' => "user", 'breadcrumb' => 'User', 'user' => $users, 'page' => $page, 'search' => "", 'jumlah' => $jumlah];

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
            'sidebar' => 'archive', 
            'breadcrumb' => 'Archive', 
            'archive' => $archive, 
            'page' => $page, 
            'search' => $search, 
            'jumlah' => $jumlah
        ];

        return view('admin.archive')->with('data', $data);
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
        $filename = time()."_".$request->nomor_arsip.".".$request->file->getClientOriginalExtension();
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
        $file_location = public_path('storage\file_arsip\\'.$file);
        return response()->download($file_location);
    }

    public function delete_arsip(Request $request)
    {
        $id = $request->query("id");
        $query = DB::table('archive')
        ->where('id', '=', $id);

        $filename = $query->first()->file;

        File::delete(public_path('storage\file_arsip\\'.$filename));
        $query->delete();
        return redirect()->back()->with('success', 'berhasil');

    }

    public function update_arsip(Request $request){
        $id = $request->id;
        $archive = DB::table('archive')
        ->where('id', '=', $id);

        $user = Auth::user();
        if (empty($request->file)){
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
        }else{
            File::delete(public_path('storage\file_arsip\\'.$request->old_file));
            $file = $request->file('file');
            $filename = time()."_".$request->nomor_arsip.".".$request->file->getClientOriginalExtension();
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
