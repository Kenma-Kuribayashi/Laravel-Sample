@extends('layout')

@section('content')

    {{-- <div>{{ $errors }}</div> --}}

  <div id="app">
    <router-view :auth="{{ Auth::user() ?? '{}' }}"></router-view>
  </div>

  <br>

@endsection

@push('scripts')
  <script src="{{ asset('/js/page/articleList.js') }}" defer="defer"></script>
@endpush
