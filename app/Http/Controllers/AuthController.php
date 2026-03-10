<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    //画面表示
    public function index()
    {
        return view ('index');
    }

    // ログイン
    public function login()
    {
        
    }
}
