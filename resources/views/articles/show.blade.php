@extends('layout')

@section('content')

    <div id="app">
        <router-view :errors="{{ $errors }}" :auth="{{ Auth::user() ?? '[]' }}"></router-view>
    </div>


@endsection


@push('scripts')
    <script src="{{ asset('/js/page/articleList.js') }}" defer="defer"></script>
@endpush
