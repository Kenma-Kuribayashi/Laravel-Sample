@extends('layout')
 
@section('content')
  <h1>
    @auth
      {{-- ログインしている時だけ表示 --}}
      <a href="{{ route('articles.create') }}" class="btn btn-primary float-right">新規作成</a>
    @endauth
  </h1>
  
  <hr/>
 
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
@endsection