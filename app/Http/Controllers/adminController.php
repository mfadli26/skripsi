<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

        $data = (object) ['sidebar' => 'user', 'breadcrumb' => 'User', 'user' => $users, 'page' => $page, 'search' => $search, 'jumlah' => $jumlah];

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
