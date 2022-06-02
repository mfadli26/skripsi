<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Resources\ResponseCollection;
use App\Http\Response\ResponseJson;

// setlocale(LC_TIME, 'Indonesia');

class ApiLoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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

    public function login_check(Request $request)
    {

        $data = [
            'email'     => $request->email,
            'password'  => $request->password
        ];

        Auth::attempt($data);
        $responseJson = new ResponseJson();
        if (Auth::check()) {
            return $responseJson->success(Auth::user());
        } else {
            return $responseJson->unauthorized("Email or Password Wrong!");;
        }
    }

}
