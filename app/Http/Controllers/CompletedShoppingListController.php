<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\CompletedShoppingList as CompletedShoppingListModel;

class CompletedShoppingListController extends Controller
{
    protected function getListBuilder()
    {
        return CompletedShoppingListModel::where('user_id', Auth::id())
                ->orderBy('created_at');
    }

    public function list()
    {
        $per_page = 3;
        $list = $this->getListBuilder()
                     ->paginate($per_page);
        return view('shopping_list.completed_list', ['list' => $list]);
    }
}
