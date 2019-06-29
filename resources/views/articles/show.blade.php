@extends('layout')
 
@section('content')
  
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