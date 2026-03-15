<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ListRegisterPostRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Shopping_list as Shopping_listModel;
use Illuminate\Support\Facades\DB;
use App\Models\CompletedShoppingList as CompletedShoppingListModel;

class ShoppingListController extends Controller
{
    /**
     * 買うものリストページ を表示する
     * 
     * @return \Illuminate\View\View
     */
    public function list()
    {
        // 
        $per_page = 20;
        // 一覧の取得
        $list = Shopping_listModel::where('user_id', Auth::id())
                                  ->orderBy('name')
                                  ->paginate($per_page);
                                //   ->get();
        /*
        $sql = Shopping_listModel::where('user_id', Auth::id())->orderBy('name')->toSql();
        // echo "<pre>\n"; var_dump($sql, $list); exit;
        // var_dump($sql);
       */
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
        return redirect(route('front.list'));    
    }

    /**
     * 削除処理
     */
    public function delete(Request $request, $shopping_list_id)
    {
        // レコード取得
        $list = Shopping_listModel::find($shopping_list_id);
        // 削除
        if ($list !== null) {
            $list->delete();
            $request->session()->flash('front.list_delete_success', true);
        }
        // 一覧に遷移
        return redirect(route('front.list'));

    }
    /**
     * 完了
     */
    public function complete(Request $request, $shopping_list_id)
    {
        /*リストを完了テーブルに移動させる　*/
        try {
            // トランザクション開始
            DB::beginTransaction();
        
            // task_idのレコードを取得する
            $list = Shopping_listModel::find($shopping_list_id);
            if ($list === null) {
            // idが不正なのでトランザクション終了
            throw new \Exception('');
            }
            // var_dump($list->toArray()); exit;

            // テーブルから削除する
            $list->delete();

            // completed_側にinsertする
            $list_datum = $list->toArray();
            unset($list_datum['created_at']);
            unset($list_datum['updated_at']);
            $r = CompletedShoppingListModel::create($list_datum);
            if ($r === null) {
                // intertで失敗したのでトランザクション終了
                throw new \Exception('');
            }
            // echo '処理成功'; exit;

            // トランザクション終了
            DB::commit();
            // 完了メッセージ出力
            $request->session()->flash('front.list_completed_success', true);
            } catch(\Throwable $e) {
                var_dump($e->getMessage()); exit;
                //  トランザクション異常終了
                DB::rollback();
                // 完了失敗メッセージ出力
                $request->session()->flash('front.list_completed_failure', true);
            }

            // 一覧に遷移
            return redirect(route('front.list'));

        
    }
}
