<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\AdminLoginPostRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    /**
     * トップページ表示
     * 
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view ('admin.index');
    }

    // ログイン
    public function login(AdminLoginPostRequest $request)
    {
        // validate済
        // データの取得
        $datum = $request->validated();
        // var_dump($datum); exit;
        
        // 認証
        if (Auth::guard('admin')->attempt($datum) === false) {
            return back()
                   ->withInput()
                   ->withErrors(['auth' => 'ログインIDかパスワードに誤りがあります。',])
                   ;
        }

        // 認証成功
        $request->session()->regenerate();
        return redirect()->intended('/admin/top');
    }
    /**
     * ログアウト処理
     * 
     */
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->regenerateToken();
        $request->session()->regenerate();
        return redirect(route('admin.index'));
    }
}
