<?php

declare(strict_type=1);
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    /**
     * トップページ表示
     * 
     * @return \Illuminate\View\View
     */
    public function top()
    {
        return view ('admin.top');
    }

}
