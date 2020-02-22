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
  
   <div class="panel panel-default">
      @if (!empty($article->image)) <!--imageカラムが空じゃなかったら-->
        <figure>
          <img src='data:img/png;base64,{{$article->image}}' width="533px" height="400px">　<!--base64でエンコードされた画像を表示するという記法-->
        </figure>
      @endif
    </div>

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
    {{-- 投稿したユーザーのidとログインユーザーのidが一致する場合表示 --}}
    @if ($article->user_id == session('user_id'))
      <a href="{{ action('ArticlesController@edit', [$article->id]) }}" 
        class="btn btn-primary">
        編集
      </a>
    @endif

    {{-- 管理者がログインしている場合でも表示されるように要修正 --}}
    @if ($article->user_id == session('user_id'))
      {!! delete_form(['articles', $article->id]) !!}
    @endif

      <br>
      <br>

    @if ($article->user_id == session('user_id'))
      <div class="red">※画像ファイルは50KB以下でお願いします。(現在改良中のため)</div>
        <form action="/upload/{{ $article->id }}" method="POST" enctype="multipart/form-data" class="post_form"> 
          <div class="form_parts">
            <label for="photo">画像ファイル:</label>
            <input type="file" class="form-control" name="image">
            <br>
            {{ csrf_field() }}
            <button class="btn btn-success">投稿</button>
          </div>
        </form>
      </div>
    @endif

    <a href="{{ action('ArticlesController@index') }}"class="btn btn-secondary float-right">
      一覧へ戻る
    </a>

@endsection