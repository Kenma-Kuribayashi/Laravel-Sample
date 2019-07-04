@extends('layout')
 
@section('content')
  <h1>タグ</h1>
 
  <hr/>
 
 <a href="/tags/create" class="btn btn-primary">タグ追加</a>
 
 <hr/>
 
  @foreach($tags as $tag)
    <article>
      <h3 class="tag-name">{{ $tag->name }}</h3>
      {!! Form::open(['method' => 'DELETE', 'url' => ['tags', $tag->id], 'class' => 'd-inline']) !!}
        {!! Form::submit('削除', ['class' => 'btn btn-danger tag-delete']) !!}
      {!! Form::close() !!}
    </article>
    <hr/>
  @endforeach
@endsection