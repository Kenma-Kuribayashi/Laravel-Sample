@extends('layout')
 
@section('content')
  
  @include('nav-tab')

  @foreach($articles as $article)
      @foreach($article->tags as $tag) <!-- 1つの記事に対してタグを1つずつ取り出してる /-->
        @if ($tag->name == $tagname) <!--記事のタグの名前とコントローラから持ってきたtagnameが合ったとき-->
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
        @endif
      @endforeach
  @endforeach

  <br>
@endsection