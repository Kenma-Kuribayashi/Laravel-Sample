@extends('layout')

@section('content')
    <div id="app">
        <router-view :auth="{{ Auth::user() ?? '{}' }}"></router-view>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('/js/page/login.js') }}" defer="defer"></script>
@endpush
