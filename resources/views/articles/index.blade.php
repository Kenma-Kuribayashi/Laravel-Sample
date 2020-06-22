@extends('layout')
 
@section('content')

  @include('nav-tab')
 
 <div class="articles">
   @foreach($articles as $article)
     <article>
      <figure>
      @if (!empty($article->image_path))
      <img src="https://test-bucket-sample-news.s3-ap-northeast-1.amazonaws.com/myprefix/{{ $article->image_path }}" class="news-image" width="75px" height="50px">
      @else
        <img src='data:img/png;base64,{{$article->image}}' class="news-image" width="75px" height="50px">
      @endif
    </figure>
      @auth
      <a href="{{ url('articles',[$article->id, $currentUser->id]) }}" class="news-li">{{ $article->title }}</a>
      @endauth
      @guest
      <a href="{{ url('articles', $article->id) }}" class="news-li">{{ $article->title }}</a>
      @endguest
      
      <div class="created-time">
        {{ $article->created_at->format('n/d ') . '(' . 
        $week[$article->created_at->format('w')] . ')'}}
        {{ $article->created_at->format('H:i') }}
      </div>
    </article>
   @endforeach
  </div>
  
  <div class="weather">
    <script language="javascript" charset="euc-jp" type="text/javascript" src="http://weather.livedoor.com/plugin/common/forecast/20.js"></script>
    <br>
    <script language="javascript" charset="euc-jp" type="text/javascript" src="http://weather.livedoor.com/plugin/common/forecast/13.js"></script>
    <br>
    <script language="javascript" charset="euc-jp" type="text/javascript" src="http://weather.livedoor.com/plugin/common/forecast/33.js"></script>
  </div>

    
    {{-- <div id="app">  
      <example-component></example-component>
    </div> --}}
  

  <div id="app">  
    <app />
  </div>
  {{-- {{-- <script src="/js/page/articleList.js"></script> --}}

  {{-- <div class="calendar">
    <div class="non-display">
      <h3 id="year-month" clsss="calendar-title"></h3>
    </div>
      <button id="prev-month" type="button" class="btn btn-primary">&larr;</button>
      <button id="next-month" type="button" class="btn btn-primary">&rarr;</button>
      <table>
      <tr>
        <td class="calendar-td">日</td>
        <td class="calendar-td">月</td>
        <td class="calendar-td">火</td>
        <td class="calendar-td">水</td>
        <td class="calendar-td">木</td>
        <td class="calendar-td">金</td>
        <td class="calendar-td">土</td>
      </tr>
      </table>
    </div>
      <div id="calendar" ></div>
  </div> --}}
  
  <br>
  {{ $articles->links() }} <!--ページネーション-->

@endsection

@push('scripts')
  <script src="{{ asset('/js/page/articleList.js') }}" defer="defer"></script>
@endpush