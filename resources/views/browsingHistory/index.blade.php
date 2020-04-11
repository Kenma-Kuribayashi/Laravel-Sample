@extends('layout')
 
@section('content')

<div class="page-header">
  <h1>最近閲覧した記事</h1>
</div>
@foreach ($browsingHistories as $browsingHistory)

<h3>・{{ $browsingHistory->article->title }}</h3>

@endforeach

@endsection