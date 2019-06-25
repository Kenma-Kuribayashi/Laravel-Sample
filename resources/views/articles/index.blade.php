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
      <ul>
        <li class="news-li">
          <a href="{{ url('articles', $article->id) }}">{{ $article->title }}</a>
          <div class="created-time">
            {{ $article->created_at->format('n/d') }}
            <?php
              $week = ['日','月','火','水', '木', '金', '土', ];
              $date = date('w');
              echo '(' . $week[$date] . ')';?>
            {{ $article->created_at->format('H:i') }}
          </div>
        </li>
      </ul>
    </article>
  @endforeach
@endsection