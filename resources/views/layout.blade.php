<!DOCTYPE HTML>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>Sample News</title>
    <link rel="stylesheet" href="/css/app.css">
    <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
    <script src="/js/app.js" defer></script>
</head>
<body>
  {{-- ナビゲーションバーの Partial を使用 --}}
  @guest
  @else
    @include('navbar')
  @endguest
  <div class="header">
    <h1><a class="main-logo" href="/articles">Sample!</a></h1>
    <a class="sub-logo" href="/articles">ニュース</a>
   
    @guest <!-- ログインしていない時のメニュー -->
      <a class="about" href="/about">利用方法</a>
      <a class="login" href="{{ route('login') }}">ログイン</a>
      <a class="register" href="{{ route('register') }}">新規登録</a>
    @endguest
  </div>
  
  <div class="container">
    {{-- フラッシュメッセージの表示 --}}
    @if (Session::has('flash_message'))
      <div class="alert alert-success">{{ Session::get('flash_message') }}</div>
    @endif
 
    <h1 class="new-article-btn">
      @auth {{-- ログインしている時だけ表示 --}}
        <a href="{{ route('articles.create') }}" class="btn btn-primary ">新規作成</a>
      @endauth
    </h1>
 
    <div class="sns-icon">
      <a href="https://twitter.com/" target="_blank"><i class="fa fa-twitter"></i></a>
      <a href="https://ja-jp.facebook.com/login/" target="_blank"><i class="fa fa-facebook"></i></a>
    </div>
 
    {{-- コンテンツの表示 --}}
    @yield('content')
  </div>
  
</body>
</html>