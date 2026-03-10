<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginPostRequest;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * トップページ表示
     * 
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view ('index');
    }

    // ログイン
    public function login(LoginPostRequest $request)
    {
        // validate済
        // データの取得
        $datum = $request->validated();
        // 
        // var_dump($datum); exit;
        
        // 認証失敗
        if (Auth::attempt($datum) === false) {
            return back()
                   ->withInput()
                   ->withErrors(['auth' => 'emailかパスワードに誤りがあります。',])
                   ;
        }

        // 認証成功
        $request->session()->regenerate();
        return redirect()->intended('/shopping_list');
    }
}
