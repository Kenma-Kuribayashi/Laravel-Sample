@extends('layout')
 
@section('content')
  <h1>記事の新規投稿</h1>
  
  @include('errors.form_errors')
 
    <form action="/articles" method="POST" enctype="multipart/form-data" class="post_form"> 
      {{ csrf_field() }}
      @include('articles.form', ['published_at' => date('Y-m-d'), 'submitButton' => '新規投稿'])
      <div class="red">※画像ファイルは50KB以下でお願いします。(現在改良中のため)</div>

          <div class="form_parts">
            <label for="photo">画像ファイル:</label>
            <input type="file" class="form-control" name="image">
            <br>
            <button class="btn btn-success">投稿</button>
          </div>
      </div>
    </form>
  
@endsection