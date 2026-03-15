<?php

declare(strict_type=1);
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User as UserModel;

class UserController extends Controller
{
    /**
     * トップページ表示
     * 
     * @return \Illuminate\View\View
     */
    public function list()
    {
        // データの取得
        $group_by_colum = ['users.id', 'users.name'];
        $list = UserModel::select($group_by_colum)
                          ->selectRaw('count(shopping_lists.id) AS lists_num')
                          ->leftJoin('shopping_lists', 'users.id', '=', 'shopping_lists.user_id')
                          ->groupBy($group_by_colum)
                          ->orderBy('users.id')
                          ->get();
        // echo "<pre>\n";
        // var_dump($list->toArray()); exit;

        return view ('admin.user.list', ['users' => $list]);
    }

    /**
     * 会員登録画面表示
     */
    public function index()
    {
        // 要確認
        return view (route('front.user.register'));
    }
    /**
     * 
     */
    // 登録処理
    public function register(UserRegisterPost $request)
    {
        // validate済みのデータの取得
        $datum = $request->validated();
        // パスワードのハッシュ化
        $datum['password'] = Hash::make($datum['password']);

        // テーブルへのINSERT　対象のテーブルは、users
        DB::table('users')->insert($datum);

        // 登録成功
        $request->session()->flash('front.User_register_success', true);

        // リダイレクト
        return redirect(route('front.index'));
    }
}
