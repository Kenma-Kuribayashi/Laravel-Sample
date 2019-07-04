@extends('layout')
 
@section('content')
  <h1 class="new-article">
    @auth
      {{-- ログインしている時だけ表示 --}}
      <a href="{{ route('articles.create') }}" class="btn btn-primary float-right">新規作成</a>
    @endauth
  </h1>
  
<div class="nav-body">
  <ul class="nav nav-tabs">
    <li class="nav-item">
      <a class="nav-link active" href="#">主要</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#">国内</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#">国際</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#">経済</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#">エンタメ</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#">スポーツ</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#">IT</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#">科学</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#">ライフ</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#">地域</a>
    </li>
  </ul>
</div>
 
  @foreach($articles as $article)
    <article>
        <figure>
          <img src="/storage/{{ $article->id }}.jpg" class="news-image" width="50px" height="50px">
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
  <br>
  {{ $articles->links() }}
@endsection