@extends('layouts.app')
@section('title', '記事詳細ページ')

@section('content')
    @php
        $converter = new \cebe\markdown\MarkdownExtra();
        $item->message = $converter->parse($item->message);
    @endphp
    @if($item !== '')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ $item->title }}</div>
                    <div class="card-body">
                        <!-- <div class="headcopy">Title</div><hr>
                        <div class="text">{{ $item->title }}</div>
                        <br> -->
                        <!-- <div class="headcopy">Message</div><hr> -->

                        <div class="text">
                            {!! $item->message !!}
                            <!-- {{ $item->message }} -->
                        </div>

                        <!-- 主キーと外部キーが同じ場合 -> リンク付きテキストと削除ボタン表示 -->
                        @if($authUser->id === $item->user_id)
                        <form action="/post/{{$item->id}}" method="POST">
                            @csrf

                            <!-- 認証ユーザーのid取得 -->
                            <input type="hidden" name="user_id" value="{{ $authUser->id }}">
                            <!-- <input type="hidden" name="user_id" value="1"> -->
                            <input type="text" class="form_edit" name="title" placeholder="タイトル" value="{{ $item->title }}">
                            <div>
                                <textarea class="form_edit" name="message" placeholder="メッセージ">{!! $item->message !!}</textarea>
                                <!-- <textarea class="form_edit" name="message" placeholder="メッセージ">{{ $item->message }}</textarea> -->
                                </textarea>
                            </div>
                                <div class="updateBtn">
                                    <input type="hidden" name="_method" value="PUT">
                                    <input type="submit" class="btn-square-emboss update" value="変　更">
                                </div>
                        </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

@endsection