<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ListRegisterPostRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Shopping_list as Shopping_listModel;

class ShoppingListController extends Controller
{
    /**
     * 買うものリストページ を表示する
     * 
     * @return \Illuminate\View\View
     */
    public function list()
    {
        // 一覧の取得
        $list = Shopping_listModel::where('user_id', Auth::id())->orderBy('name')->get();
        $sql = Shopping_listModel::where('user_id', Auth::id())->orderBy('name')->toSql();
        // echo "<pre>\n"; var_dump($sql, $list); exit;
        // var_dump($sql);

        return view('shopping_list.list', ['list' => $list]);
    }
    /**
     * 買うもの　登録
     */
    public function register(ListRegisterPostRequest $request)
    {
        // データの取得
        $datum = $request->validated();
        // user_idの追加
        $datum['user_id'] = Auth::id();
        // テーブルへのinsert 
        try {
            $r = Shopping_listModel::create($datum);
            // var_dump($r); exit;
        } catch(\Throwable $e) {
            // 
            echo $e->getMessage();
            exit;
        }
        // リスト登録成功
        $request->session()->flash('front.list_register_success', true);

        //  リダイレクト    
        return redirect('shopping_list/list');
    }

    
}
