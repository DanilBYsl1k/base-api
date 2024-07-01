<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;

class AuthController extends BaseController
{
    //Login api - post
    public function login(LoginRequest $request)
    {

    }

    //Register api - post
    public function register(RegisterRequest $request)
    {
        $data = $request->validated();

    }

    public function logout(Request $request)
    {

    }

    //Profile api - get
    public function profile(Request $request)
    {

    }

    //Refresh api - get
    public function refreshToken(Request $request)
    {

    }

    //Profile api - get
    public function resetPassword(Request $request)
    {

    }
}
