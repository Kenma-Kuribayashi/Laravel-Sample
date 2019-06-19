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
  @include('navbar')
  
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