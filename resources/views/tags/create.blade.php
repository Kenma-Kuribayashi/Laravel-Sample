@extends('layout')
 
@section('content')
  <h1>タグ追加</h1>
 
  <hr/>
 
  {!! Form::open(['url' => 'tags']) !!}
    <div class="form-group">
      {!! Form::label('name', 'タグ名') !!}
      {!! Form::text('name', null, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
      {!! Form::submit('タグ追加', ['class' => 'btn btn-primary form-control']) !!}
    </div>
  {!! Form::close() !!}
@endsection