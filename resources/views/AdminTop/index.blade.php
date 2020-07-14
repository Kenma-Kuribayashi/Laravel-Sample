@extends('layout')
 
@section('content')

<div>ユーザー一覧</div>

@foreach ($users as $user)

<div>・{{ $user->getName() }}</div>

@if($user->isContributor())
<div>○</div>
@else
<form method="post" action="/users/{{ $user->getId() }}">
  {{ csrf_field() }}
  <input type="hidden" name="_method" value="PUT">
  <input type="submit" value="投稿者登録する" />
</form>

@endif

@endforeach

@endsection