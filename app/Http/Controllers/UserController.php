<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserPostRequest;

class UserController extends Controller
{
    /**
     * 会員登録画面表示
     */
    public function index()
    {
        return view ('user.register');
    }

    // 登録処理
    public function register(UserPostRequest $request)
    {
        // validate済みのデータの取得
        $datum = $request->validated();
        // パスワードのハッシュ化
        $datum['password'] = Hash::make($datum['password']);
        // var_dump($datum); exit;

        // テーブルへのINSERT　対象のテーブルは、users
        DB::table('users')->insert($datum);

        // 登録成功
        $request->session()->flash('front.user_register_success', true);

        // リダイレクト
        return redirect(route('front.index'));
    }
}
