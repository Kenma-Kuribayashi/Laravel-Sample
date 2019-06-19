@extends('layout')
 
@section('content')
  <h1>Write a New Article</h1>
 
  <hr/>
 
  @include('errors.form_errors')
 
  {{-- Form::open(['url' => 'articles']) --}}
    {!! Form::open(['route' => 'articles.store']) !!}
      @include('articles.form', ['published_at' => date('Y-m-d'), 'submitButton' => 'Add Article'])
    {!! Form::close() !!}
    
@endsection