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
<!-- 外部読み込み可能、継承不可、変数渡し可能、デフォルト設定不可 -->

<!-- @yield -->
<!-- 外部読み込み可能、継承不可、変数渡し不可、デフォルト設定可能 -->

<!-- @section -->
<!-- 外部読み込み可能、継承可能、変数渡し不可、デフォルト設定可能 -->