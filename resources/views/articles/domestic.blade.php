@extends('layout')
 
@section('content')
  
  @include('nav-tab')

  @foreach($articles_by_tag as $article)
    <article>
      <figure>
        <img src='data:img/png;base64,{{$article->image}}' class="news-image" width="75px" height="50px">
      </figure>
      <a href="{{ url('articles', $article->id) }}" class="news-li">{{ $article->title }}</a>
      <div class="created-time">
        {{ $article->created_at->format('n/d') . ' (' . $week[$article->created_at->format('w')] . ')' }}
        {{ $article->created_at->format('H:i') }}
      </div>
    </article>
  @endforeach
  
  {{ $articles_by_tag->links() }}

@endsection