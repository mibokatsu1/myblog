@extends('layouts.app')
@section('title', '記事詳細ページ')

@section('content')
    @if($item !== '')
        <div class="headcopy">Title</div><hr>
        <div class="text">{{ $item->title }}</div>

        <div class="headcopy">Message</div><hr>
        <div class="text">{{ $item->message }}</div>
    @endif

@endsection