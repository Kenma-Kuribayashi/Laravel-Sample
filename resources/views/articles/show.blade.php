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
 
  @auth
  <div>
    {{-- 投稿したユーザーのidとログインユーザーのidが一致する場合表示 --}}
    @if ($article->user_id === $currentUser->id)
      <a href="{{ action('ArticlesController@edit', [$article->id]) }}" 
        class="btn btn-primary">
        編集
      </a>
    @endif

    {{-- 管理者の場合は投稿者でなくても表示 --}}
    @if ($article->user_id === $currentUser->id || $currentUser->is_admin)
      {!! delete_form(['articles', $article->id]) !!}
    @endif

      <br>
      <br>

    @if ($article->user_id === $currentUser->id)
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

    @endauth
    
    <a href="{{ action('ArticlesController@index') }}"class="btn btn-secondary float-right">
      一覧へ戻る
    </a>

    <br>
    <div class="">おすすめの記事</div>

    <div class="articles">
      @foreach($recommended_articles as $recommended_article)
        <article>
          <figure>
           <img src='data:img/png;base64,{{$recommended_article->image}}' class="news-image" width="75px" height="50px">
         </figure>
         <a href="{{ url('articles', $recommended_article->id) }}" class="news-li">{{ $recommended_article->title }}</a>
         <div class="created-time">
           {{ $recommended_article->created_at->format('n/d ') . '(' . 
           $week[$recommended_article->created_at->format('w')] . ')'}}
           {{ $recommended_article->created_at->format('H:i') }}
         </div>
       </article>
      @endforeach
     </div>

@endsection