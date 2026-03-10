<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShoppingListController extends Controller
{
    /**
     * 買うものリストページ を表示する
     * 
     * @return \Illuminate\View\View
     */
    public function list()
    {
        return view('shopping_list.list');
    }
}
