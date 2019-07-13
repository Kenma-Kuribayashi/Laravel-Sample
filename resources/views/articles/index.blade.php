@extends('layout')
 
@section('content')
  <h1 class="new-article">
    @auth
      {{-- ログインしている時だけ表示 --}}
      <a href="{{ route('articles.create') }}" class="btn btn-primary float-right">新規作成</a>
    @endauth
  </h1>
  
  @include('nav-tab')
 
  @foreach($articles as $article)
    <article>
      @foreach($bbs as $bb) <!--Bbsテーブルから1つずつ取り出してる→無駄-->
        @if (!empty($bb->image)) 
          @if ($article->id == $bb->id)  <!--記事のidと画像のidがあったときだけ表示する-->
            <figure>
              <img src='data:img/png;base64,{{$bb->image}}' class="news-image" width="50px" height="50px">
            </figure>
          @endif
        @endif
      @endforeach
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