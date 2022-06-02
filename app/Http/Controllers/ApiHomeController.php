<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Resources\ResponseCollection;
use App\Http\Response\ResponseJson;
// setlocale(LC_TIME, 'Indonesia');

class ApiHomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    public function __construct() 
    {
        $this->responseJson = new ResponseJson();
    }

    public function get_user_profile(Request $request, $id)
    {
        try{
            $user = User::findOrFail($id);
            return $this->responseJson->success($user);
        } catch (\Exception $e) {
            return $this->responseJson->not_found("Email or Password Wrong!");;
        }
    }
}
