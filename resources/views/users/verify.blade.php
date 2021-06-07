@extends('layout')

@section('content')

    <div id="app">
        <router-view :auth="[]"></router-view>
    </div>

@endsection

@push('scripts')
    <script src="{{ asset('/js/page/articleList.js') }}" defer="defer"></script>
@endpush
