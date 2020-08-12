@extends('layouts.app')
<!-- タイトルはデフォルトと同じ -->
<!-- @section('title', 'トップページ') -->

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">新しい記事を投稿してください</div>
                <div class="card-body">

                    <!-- 投稿フォーム -->
                    <form action="/post" method="post">
                        @csrf

                        <!-- 認証ユーザーのid取得 -->
                        <input type="hidden" name="user_id" value="{{ $authUser->id }}">
                        <!-- <input type="hidden" name="user_id" value="1">  ユーザー登録機能実装前、仮置き -->

                        <!-- @if($errors->has('title'))
                            <div class="error_msg">{{ $errors->first('title') }}</div>
                        @endif
                        <input type="text" class="form" name="title" placeholder="タイトル" value="{{ old('title') }}"> -->
                        <div class="">
                            <div class="labelTitle">タイトル</div>
                            <input id="title" type="text" class="userForm" name="title" placeholder="タイトル" value="{{ old('title') }}">
                            @if($errors->has('title'))
                                <div class="error_msg">{{ $errors->first('title') }}</div>
                            @endif
                        </div>


                        <!-- @if($errors->has('message'))
                            <div class="error_msg">{{ $errors->first('message') }}</div>
                        @endif
                        <div>
                            <textarea class="form" name="message" placeholder="メッセージ">{{ old('message') }}</textarea>
                        </div> -->
                        <div class="">
                            <div class="labelTitle">メッセージ</div>
                            <textarea id="message" class="userForm" name="message" placeholder="メッセージ">{{ old('message') }}</textarea>
                            @if($errors->has('message'))
                                <div class="error_msg">{{ $errors->first('message') }}</div>
                            @endif
                        </div>

                        <!-- <input type="submit" class="create" value="投  稿"> -->
                        <div class="buttonSet">
                            <input type="submit" class="btn-square-emboss" value="SEND">
                            <!-- <input type="submit" class="btn btn-primary btn-sm postBtn" value="投稿する"> -->
                        </div>
                    </form>
                    <!-- <div class="card-body-2">
                        <form action="//example.com/upload" method=post id=editor_form data-redirect-url="//example.com/redirect">
                            ＠csrf
                            <div id=editor_area contenteditable=true class=editor_area></div>
                            <input type=submit value="送信" id=submit_button>
                        </form>
                    </div> -->
                    <div class="paginate">
                        {{ $items->links() }}
                    </div>

                    <!-- 記事描画部分 -->
                    <div class="createItem">
                        @if(count($items) > 0)
                            @foreach($items as $item)
                                <div class="alert alert-success" role="alert">
                                    <div class="comment">
                                        <a href="/post/{{ $item->id }}" class="alert-link">{{ $item->title }}</a>
                                        <br/>
                                        @php
                                            $converter = new \cebe\markdown\MarkdownExtra();
                                            $item->message = $converter->parse($item->message);
                                        @endphp
                                        {!! $item->message !!}
                                        <!-- {{ $item->message }} -->
                                        <div class="created_at">{{ $item->created_at}}</div>
                                    </div>

                                    <!-- 主キーと外部キーが同じ場合 -> リンク付きテキストと削除ボタン表示 -->
                                    @if($authUser->id === $item->user_id)
                                    <div class="delete">
                                        <form action="/post/{{ $item->id }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="_method" value="DELETE">
                                            <!-- <input type="submit" class="delete" value="削除"> -->
                                            <button type="submit" class="deleteIcon">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </div>
                                    @endif
                                </div>
                            @endforeach
                        @else
                            <div>投稿記事がありません</div>
                        @endif
                    </div>
                    <div class="paginate">
                        {{ $items->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection