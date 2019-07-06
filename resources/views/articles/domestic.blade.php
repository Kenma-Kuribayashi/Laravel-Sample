@extends('layout')
 
@section('content')
  
  @include('nav-tab')

  @foreach($articles as $article)
      @foreach($article->tags as $tag) <!-- 1つの記事に対してタグを1つずつ取り出してる /-->
        @if ($tag->id == $id) <!--記事のタグのidとコントローラから持ってきたidが合ったとき-->
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
        @endif
      @endforeach
  @endforeach

  <br>
@endsection