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
  <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
  
  <!-- Styles -->
  <!-- <link rel="stylesheet" href="https://hypertext-candy.s3-ap-northeast-1.amazonaws.com/posts/vue-laravel-tutorial/app.css"> -->

  {{-- CSS --}}
  <!-- <link href="{{ asset('../assets/sass/style.scss') }}" rel="stylesheet"> -->
  <!-- <link href="{{ asset('sass/style.scss') }}" rel="stylesheet"> -->

  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <link href="{{ asset('css/style.css') }}" rel="stylesheet">
  <!-- <link href="{{ mix('css/style.css') }}" rel="stylesheet"> -->
  
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
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
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
            @guest
            <li class="nav-item">    
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/') }}">User</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('post.index') }}">Post</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/') }}">Login</a>
                </li>
                @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/') }}">{{ __('Register') }}</a>
                    </li>
                @endif
            @else
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/') }}">User</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('post.index') }}">Post</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/') }}">Login</a>
                </li>

                <li class="nav-item dropdown">
                  <a id="navbarDropdown" class="nav-link dropdown-toggle" href="{{ url('/') }}" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                      {{ Auth::user()->name }} <span class="caret"></span>
                  </a>

                  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ url('/') }}">
                        ログアウト
                    </a>

                    <form id="logout-form" action="{{ url('#') }}" method="POST">
                        @csrf
                    </form>
                  </div>
                </li>
            @endguest
          </ul>
        </div>
      </div>
    </nav>
    <main class="py-4">
        @yield('content')
    </main>

    <!-- フッター -->
    <div class="test">
        フッター
    </div>

    <div class="links">
      <a href="https://laravel.com/docs"><button class='btn btn-default'>Docs</button></a>
      <a href="https://laracasts.com"><button class='btn btn-primary'>Laracasts</button></a>
      <a href="https://laravel-news.com"><button class='btn btn-success'>News</button></a>
      <a href="https://blog.laravel.com"><button class='btn btn-info'>Blog</button></a>
      <a href="https://nova.laravel.com"><button class='btn btn-warning'>Nova</button></a>
      <a href="https://forge.laravel.com"><button class='btn btn-danger'>Forge</button></a>
      <a href="https://vapor.laravel.com"><button class='btn btn-link'>Vapor</button></a>
      <a href="https://github.com/laravel/laravel"><button class='btn btn-primary'>GitHub</button></a>
    </div>
  </div>

  <script src="{{ asset('js/app.js') }}" defer></script>
</body>
</html>