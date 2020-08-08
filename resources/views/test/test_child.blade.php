@extends('test.test_parent')


@section('content')

    <h1>子のコンテンツ</h1>
@endsection


@section('title', '子のタイトル')


@section('footer')
    @parent

    <h1>子のフッター</h1>
@endsection


<!-- ＠include -->