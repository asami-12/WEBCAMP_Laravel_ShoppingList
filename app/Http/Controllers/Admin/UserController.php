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
                          ->selectRaw('count(completed_shopping_lists.id) AS list_num')
                          ->leftJoin('completed_shopping_lists', 'users.id', '=', 'completed_shopping_lists.user_id')
                          ->groupBy($group_by_colum)
                          ->orderBy('users.id')
                          ->get();
        // echo "<pre>\n";
        // var_dump($list->toArray()); exit;

        return view ('admin.user.list', ['users' => $list]);
    }

}
