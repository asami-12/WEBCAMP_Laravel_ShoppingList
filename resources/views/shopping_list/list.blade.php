@extends('layout')

{{-- タイトル --}}
@section('title')(買うものリスト)@endsection

{{-- メインコンテンツ --}}
@section('contents')
        <h1>「買うもの」の登録</h1>
            @if (session('front.list_register_success') == true)
                「買うもの」を登録しました！！<br>
            @endif
            @if ($errors->any())
            <div>
            @foreach ($errors->all() as $error)
                {{ $error }}<br>
            @endforeach
            </div>
            @endif
            <form action="/shopping_list/register" method="post">
                @csrf
                「買うもの」名：<input type="text" name="name"><br>
                <button>「買うもの」を登録する</button>
            </form>

        <h1>買うもの」一覧</h1>
        <!-- 購入済み「買うもの」一覧 -->
         <table border="1">
            <tr>
                <th>登録日
                <th>「買うもの」名
            @foreach ($list as $item)
            <tr>
                <td>{{ $item->created_at }}
                <td>{{ $item->name }}
                <td><button>完了</button>
                <td><button>削除</button>
            @endforeach
         </table>
         <!-- ページネーション -->
          現在 1 ページ目<br>
        <a href="./top.html">最初のページ</a> / 
        <a href="./top.html">前に戻る</a> / 
        <a href="./top.html">次に進む</a>
        <br>
        <hr>
        <menu label="リンク">
        <a href="/logout">ログアウト</a><br>
        </menu>
@endsection