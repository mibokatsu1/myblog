<html>
<head>
    <title>Laravel | @yield('title', 'Home')</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>
<body>
    <h1>開始位置　確認</h1>
    <div id='container'>
        @yield('content')
    </div>


    @yield('footer')

    @section('footer')
        <h1>親のフッター</h1>
    @show
    <h1>閉じる位置　確認</h1>
</body>
</html>