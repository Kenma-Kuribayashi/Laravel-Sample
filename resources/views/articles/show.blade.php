@extends('layout')
 
@section('content')
  
  @include('nav-tab')
  
  @if ($errors->any())
  <ul>
    @foreach($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach
  </ul>
  @endif
  
  
  
  <form action="{{ url('upload') }}" method="POST" enctype="multipart/form-data">
    <!-- アップロードした画像。なければ表示しない -->
    @isset ($filename)
    <div>
      <img src="{{ asset('storage/' . $filename) }}">  
    </div>
    @endisset

    <label for="photo">画像ファイル:</label>
    <input type="file" class="form-control" name="image">
    <br>
    <hr>
    {{ csrf_field() }}
    <button class="btn btn-success"> Upload </button>
  </form>
  
  <figure>
    <img src="/storage/{{ $article->id }}.jpg" width="300px" height="300px">
  </figure>

  <h1>{{ $article->title }}</h1>
 
  <article>
    <div class="body">{{ $article->body }}</div>
  </article>
  
  @unless ($article->tags->isEmpty())
   <h5>Tags:</h5>
    <ul>
      @foreach($article->tags as $tag)
        <li>{{ $tag->name }}</li>
      @endforeach
    </ul>
  @endunless
 
  <div>
    {{-- ログインしている時だけ表示 --}}
    @auth
      <a href="{{ action('ArticlesController@edit', [$article->id]) }}"
        class="btn btn-primary"
      >
        編集
      </a>
      {!! delete_form(['articles', $article->id]) !!}
    @endauth
    <a href="{{ action('ArticlesController@index') }}"class="btn btn-secondary float-right">
      一覧へ戻る
    </a>
  </div>
@endsection