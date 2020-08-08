@extends('layouts.app')
@section('title', '記事詳細ページ')

@section('content')
    <!-- 認証ユーザーのid取得 -->
    <input type="hidden" name="user_id" value="{{ $authUser->id }}">

    @if($item !== '')
        <div class="headcopy">Title</div><hr>
        <div class="text">{{ $item->title }}</div>

        <div class="headcopy">Message</div><hr>
        <div class="text">{{ $item->message }}</div>

        <!-- 主キーと外部キーが同じ場合 -> リンク付きテキストと削除ボタン表示 -->
        @if($authUser->id === $item->user_id)
        <form action="/post/{{$item->id}}" method="POST">
            @csrf

            <input type="hidden" name="user_id" value="1">
            <input type="text" class="form" name="title" placeholder="タイトル" value="{{ $item->title }}">
            <div>
                <textarea class="form" name="message" placeholder="メッセージ">{{ $item->message }}</textarea>
            </div>
            <input type="hidden" name="_method" value="PUT">
            <input type="submit" class="update" value="変　更">
        </form>
        @endif
    @endif

    <a href="/post" class="edit">編集する</a>
@endsection