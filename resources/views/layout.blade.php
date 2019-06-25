<!DOCTYPE HTML>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>My Blog</title>
    <link rel="stylesheet" href="/css/app.css">
    <script src="/js/app.js" defer></script>
</head>
<body>
  {{-- ナビゲーションバーの Partial を使用 --}}
  {{-- @include('navbar') --}}
  <div class="header">
    <h1><a class="main-logo" href="{{ route('home') }}">Sample!</a></h1>
    <a class="sub-logo" href="{{ route('home') }}">ニュース</a>
    @guest <!-- ログインしていない時のメニュー -->
      <a class="login" href="{{ route('login') }}">ログイン</a>
      <a class="register" href="{{ route('register') }}">新規登録</a>
    @else <!-- ログインしている時のメニュー -->
      <a class="logout" href="#"
        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        ログアウト
      </a>
      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
      </form>
        @endguest
  </div>
  
  <div class="container">
    {{-- フラッシュメッセージの表示 --}}
    @if (Session::has('flash_message'))
      <div class="alert alert-success">{{ Session::get('flash_message') }}</div>
    @endif
 
    {{-- コンテンツの表示 --}}
    @yield('content')
  </div>
</body>
</html>