@extends('layout')
 
@section('content')
  <h1>Edit: {{ $article->title }}</h1>
 
  <hr/>
 
  {{-- エラーの表示 --}}
  @include('errors.form_errors')
 
  {!! Form::model($article, ['method' => 'POST', 'route' => ['articles.update', $article->id]]) !!}
    @include('articles.form', ['published_at' => $article->published_at->format('Y-m-d'), 'submitButton' => 'Edit Article'])
  {!! Form::close() !!}
  
@endsection