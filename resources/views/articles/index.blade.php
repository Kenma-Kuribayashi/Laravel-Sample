@extends('layout')
 
@section('content')
  <h1 class="new-article">
    @auth
      {{-- ログインしている時だけ表示 --}}
      <a href="{{ route('articles.create') }}" class="btn btn-primary float-right">新規作成</a>
    @endauth
  </h1>
  
  @include('nav-tab')
 
 <div class="articles">
  @foreach($articles as $article)
    <article>
      <figure>
        <img src='data:img/png;base64,{{$article->image}}' class="news-image" width="75px" height="50px">
      </figure>
      <a href="{{ url('articles', $article->id) }}" class="news-li">{{ $article->title }}</a>
      <div class="created-time">
        {{ $article->created_at->format('n/d') }}
        <?php
          $week = ['日','月','火','水', '木', '金', '土', ];
          $date = date('w');
          echo '(' . $week[$date] . ')';
        ?>
        {{ $article->created_at->format('H:i') }}
      </div>
    </article>
  @endforeach
  </div>
  
  <div class="weather">
    <script language="javascript" charset="euc-jp" type="text/javascript" src="http://weather.livedoor.com/plugin/common/forecast/20.js"></script>
    <br>
    <script language="javascript" charset="euc-jp" type="text/javascript" src="http://weather.livedoor.com/plugin/common/forecast/13.js"></script>
    <br>
    <script language="javascript" charset="euc-jp" type="text/javascript" src="http://weather.livedoor.com/plugin/common/forecast/33.js"></script>
  </div>
  
  <?php
$res = file_get_contents('http://weather.livedoor.com/forecast/webservice/json/v1?city=130010');
$weather = json_decode($res, true);
?>
@endsection