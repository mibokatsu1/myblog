<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ config('app.name') }} | @yield('title', 'トップページ')</title>

  <!-- Scripts -->

  <!-- Fonts -->
  <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
  
  <!-- Styles -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/github-markdown-css/3.0.1/github-markdown.min.css">

  {{-- CSS --}}
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <link href="{{ mix('css/style.css') }}" rel="stylesheet">

</head>
<body>
  <div id="app">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
      <div class="container">
        <a class="navbar-brand appName" href="{{ url('/post') }}">
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
                    <a class="nav-link" href="{{ url('home') }}">User</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('post.index') }}">Post</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('home') }}">Login</a>
                </li>
                @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/') }}">{{ __('Register') }}</a>
                    </li>
                @endif
            @else
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('home') }}">User</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('post.index') }}">Post</a>
                </li>
                @if(Auth::check())
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('user.logout') }}">Logout</a>
                </li>
                @endif
                <li class="nav-item dropdown">
                  <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                      {{ Auth::user()->name }} <span class="caret"></span>
                  </a>

                  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    @if(Auth::check())
                      <!-- <li><a href="{{ route('user.logout') }}">ログアウト</a></li> -->
                      <a class="dropdown-item" href="{{ route('user.logout') }}"
                          onclick="event.preventDefault();
                              document.getElementById('logout-form').submit();">
                          {{ __('Logout') }}
                      </a>
                      <form id="logout-form" action="{{ route('user.logout') }}" method="GET">
                          @csrf
                      </form>
                    @endif
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
    <div class="links">
      <a href="https://twitter.com/"><i class="fab fa-twitter">twitter</i></a>
      <a href="https://github.com"><i class="fab fa-github">GitHub</i></a>
      <a href="https://ja-jp.facebook.com"><i class="fab fa-facebook-square">facebook</i></a>
      <a href="https://www.instagram.com/?hl=ja"><i class="fab fa-instagram">Instagram</i></a>
      <a href="https://www.youtube.com"><i class="fab fa-youtube">youtube</i></a>
      <!-- <a href="https://www.android.com/intl/ja_jp/"><i class="fab fa-android"></i></a>
      <a href="https://www.apple.com/jp/"><i class="fab fa-apple"></i></a> -->
      <a href="https://www.google.com/"><i class="fab fa-google"></i>google</a>
      <span class="fa-stack" style="color:#4cb10d">
          <i class="fa fa-square fa-stack-2x"></i>
          <a href="https://qiita.com/"><i class="fa fa-search fa-stack-1x fa-inverse fa-2x"></i></a>
      </span>Qiita
    </div>
  </div>

  <!-- <script src="{{ asset('js/app.js') }}" defer></script> -->
  <!-- <script src="{{ asset('js/main.js') }}" defer></script> -->
  <script src="{{mix('js/app.js')}}"></script>
  <!-- <script src="{{mix('js/main.js')}}"></script> -->
</body>
</html>