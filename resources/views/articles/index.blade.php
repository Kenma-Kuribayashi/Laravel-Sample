@extends('layout')

@section('content')

  <div id="app">
    <router-view :auth="{{ Auth::user() ?? '[]' }}"></router-view>
  </div>

  <div class="weather">
    <script language="javascript" charset="euc-jp" type="text/javascript" src="http://weather.livedoor.com/plugin/common/forecast/20.js"></script>
    <br>
    <script language="javascript" charset="euc-jp" type="text/javascript" src="http://weather.livedoor.com/plugin/common/forecast/13.js"></script>
    <br>
    <script language="javascript" charset="euc-jp" type="text/javascript" src="http://weather.livedoor.com/plugin/common/forecast/33.js"></script>
  </div>

  <br>

@endsection

@push('scripts')
  <script src="{{ asset('/js/page/articleList.js') }}" defer="defer"></script>
@endpush
