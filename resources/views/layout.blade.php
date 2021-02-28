<!DOCTYPE HTML>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Sample News</title>
    <link rel="stylesheet" href="/css/app.css">
    <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
    <script src="/js/app.js" defer></script>
    @stack('scripts')
</head>
<body>
  {{-- ナビゲーションバーの Partial を使用 --}}
  @guest
  @else
    @include('navbar')
  @endguest
  <div class="header">
    <h1><a class="main-logo" href="/">Sample!</a></h1>
    <a class="sub-logo" href="/">ニュース</a>

    @guest <!-- ログインしていない時のメニュー -->
      <a class="about" href="/about">利用方法</a>
      <a class="btn" id="login" href="{{ route('login') }}">ログイン</a>
      <div class="login-text" id="login-text">投稿者の方はこちらからログインしてください</div>
      <div class="seven-days-later" id="seven-days-later"></div>
      {{-- <a class="register" href="{{ route('register') }}">新規登録</a> --}}
    @endguest
  </div>

  <br>
  <div class="container">
    {{-- フラッシュメッセージの表示 --}}
    @if (session('message'))
      <div class="alert alert-primary">{{ session('message') }}</div>
    @endif

    {{-- <h1 class="new-article-btn">
      @auth ログインしている時だけ表示
        <a href="{{ route('articles.create') }}" class="btn btn-primary ">新規作成</a>
      @endauth
    </h1> --}}

    <div class="sns-icon">
      <a href="https://twitter.com/" target="_blank"><i class="fa fa-twitter"></i></a>
      <a href="https://ja-jp.facebook.com/login/" target="_blank"><i class="fa fa-facebook"></i></a>
    </div>

    {{-- コンテンツの表示 --}}
    @yield('content')
  </div>
</body>
</html>
