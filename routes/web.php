<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\ShoppingListController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// 買い物リスト
Route::get('/', [AuthController::class, 'index'])->name('front.index');
Route::post('login', [AuthController::class, 'login']);
// 会員登録
// 認可処理
Route::prefix('/shopping_list')->group(function () {
    Route::get('/list', [ShoppingListController::class, 'list'])->name('flont.list');
});
// form入力テスト
Route::get('/test', [TestController::class, 'index']);
Route::post('/test/input', [TestController::class, 'input']);