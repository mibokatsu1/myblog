@extends('layouts.app')
<!-- タイトルはデフォルトと同じ -->
<!-- @section('title', 'トップページ') -->

@section('content')
<div class="card">
    <div class="card-header">新しい記事を投稿してください</div>

    <div class="card-body">

        <!-- 投稿フォーム -->
        <form action="post" method="post">
            @csrf

            <!-- 認証ユーザーのid取得 -->
            <input type="hidden" name="user_id" value="{{ $authUser->id }}">
            <!-- <input type="hidden" name="user_id" value="1">  ユーザー登録機能実装前、仮置き -->
            @if($errors->has('title'))
                <div class="error_msg">{{ $errors->first('title') }}</div>
            @endif
            <input type="text" class="form" name="title" placeholder="タイトル" value="{{ old('title') }}">

            @if($errors->has('message'))
                <div class="error_msg">{{ $errors->first('message') }}</div>
            @endif
            <div>
                <textarea class="form" name="message" placeholder="メッセージ">{{ old('message') }}</textarea>
            </div>
            <input type="submit" class="create" value="投  稿">
        </form>

        <!-- 記事描画部分 -->
        @if(count($items) > 0)
            @foreach($items as $item)
                <div class="alert alert-primary" role="alert">
                    <a href="/post/{{ $item->id }}" class="alert-link">{{ $item->title }}</a>
                    <div class="created_at">{{ $item->created_at}}</div>

                    <!-- 主キーと外部キーが同じ場合 -> リンク付きテキストと削除ボタン表示 -->
                    @if($authUser->id === $item->user_id)
                    <form action="/post/{{ $item->id }}" method="POST">
                    @csrf
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="submit" class="delete" value="削除">
                    </form>
                    @endif
                </div>
            @endforeach

        @else
            <div>投稿記事がありません</div>
        @endif
    </div>
</div>
@endsection