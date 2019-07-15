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
          <img src='data:img/png;base64,{{$article->image}}' width="700px" height="300px">　<!--base64でエンコードされた画像を表示するという記法-->
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

  <form action="/upload/{{$article->id}}" method="POST" enctype="multipart/form-data" class="post_form"> <!--uploadメソッドは更新する記事を特定できないので、idを渡す-->
    <div class="form_parts">
      <label for="photo">画像ファイル:</label>
      <input type="file" class="form-control" name="image">
      <br>
      {{ csrf_field() }}
      <button class="btn btn-success">投稿</button>
    </div>
   </form>
  
@endsection