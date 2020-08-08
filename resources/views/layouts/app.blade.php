<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ config('app.name') }} | @yield('title', 'トップページ')</title>

  <!-- Scripts -->
  

  <!-- Fonts -->
  <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Merriweather|Roboto:400"> -->
  <!-- <link rel="stylesheet" href="https://unpkg.com/ionicons@4.2.2/dist/css/ionicons.min.css"> -->
  
  <!-- Styles -->
  <!-- <link rel="stylesheet" href="https://hypertext-candy.s3-ap-northeast-1.amazonaws.com/posts/vue-laravel-tutorial/app.css"> -->

  {{-- CSS --}}
  <!-- <link href="{{ asset('../assets/sass/style.scss') }}" rel="stylesheet">
  <link href="{{ asset('sass/style.scss') }}" rel="stylesheet"> -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <link href="{{ asset('css/style.css') }}" rel="stylesheet">
  
</head>
<body>
  <!-- <div id="app"></div> -->

  <!-- <div id="example">
    <my-component></my-component>
  </div> -->

  <!-- コンポーネントの配置 -->
  <!-- <div id="app">
      <example-component></example-component>
  </div> -->

  <!-- <div id="app"> -->
    <!-- 呼び出しを作成したコンポーネントへ変更する -->
    <!-- <hello-world-component></hello-world-component>
  </div> -->


  <div id="app">
    <nav class="navbar">
      <div class="container">
        <a class="navbar-brand" href="{{ url('/post') }}">
          {{ config('app.name', 'Laravel') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse">
          <!-- Left Side Of Navbar -->
          <ul class="navbar-nav mr-auto">

          </ul>
          <!-- Right Side Of Navbar -->
          <ul class="navbar-nav ml-auto">
            <!-- Authentication Links -->
            ゲスト
          

            <li class="nav-item">
                <a class="nav-link" href="{{ url('/') }}">User</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ url('/') }}">Post</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ url('/') }}">Login</a>
            </li>
            register
            <li class="nav-item dropdown">
              <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                ユーザー名
              </a>

              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ url('/') }}">
                  ログアウト
                </a>

                <form id="logout-form" action="{{ url('#') }}" method="POST">
                  フォーム
                </form>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <main class="py-4">
        @yield('content')
    </main>
  </div>

  <script src="{{ mix('js/app.js') }}" defer></script>
</body>
</html>