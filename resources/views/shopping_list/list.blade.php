@extends('layout')

{{-- タイトル --}}
@section('title')(買うものリスト)@endsection

{{-- メインコンテンツ --}}
@section('contents')
        <h1>「買うもの」の登録</h1>
            <form action="./top.html" method="post">
                「買うもの」名：<input><br>
                <button>「買うもの」を登録する</button>
            </form>

        <h1>買うもの」一覧</h1>
        <!-- 購入済み「買うもの」一覧 -->
         <table border="1">
            <tr>
                <th>登録日
                <th>「買うもの」名
         </table>
         <!-- ページネーション -->
          現在 1 ページ目<br>
        <a href="./top.html">最初のページ</a> / 
        <a href="./top.html">前に戻る</a> / 
        <a href="./top.html">次に進む</a>
        <br>
        <hr>
        <menu label="リンク">
        <a href="./index.html">ログアウト</a><br>
        </menu>
@endsection