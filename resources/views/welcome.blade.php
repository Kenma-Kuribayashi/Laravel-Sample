<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    Laravel
                </div>

                <div class="links">
                    <a href="https://laravel.com/docs">Docs</a>
                    <a href="https://laracasts.com">Laracasts</a>
                    <a href="https://laravel-news.com">News</a>
                    <a href="https://blog.laravel.com">Blog</a>
                    <a href="https://nova.laravel.com">Nova</a>
                    <a href="https://forge.laravel.com">Forge</a>
                    <a href="https://github.com/laravel/laravel">GitHub</a>
                </div>
            </div>
        </div>
        <form action="welcome" method="POST" enctype="multipart/form-data" class="post_form">
          <div class="form_parts">
            <input type="file" name="image">
            <br>
            <br>
            <textarea name="comment" rows="4" cols="40"></textarea>
            <br>
            {{ csrf_field() }}
            <button class="btn btn-success">投稿</button>
          </div>
        </form>
        
        @foreach($bbs as $bb)
          <div class="panel panel-default">
            @if (!empty($bb->image)) <!--imageカラムが空じゃなかったら-->
              <img src='data:img/png;base64,{{$bb->image}}'>　<!--base64でエンコードされた画像を表示するという記法-->
            @endif
          </div>
        @endforeach
        
           <form action="{{ url('upload') }}" method="POST" enctype="multipart/form-data">
    <!-- アップロードした画像。なければ表示しない -->
    @isset ($filename)
    <div>
      <img src="{{ asset('storage/' . $filename) }}">  
    </div>
    @endisset

    <label for="photo">画像ファイル:</label>
    <input type="file" class="form-control" name="image">
    <br>
    <hr>
    {{ csrf_field() }}
    <button class="btn btn-success"> Upload </button>
  </form>
  
        
    </body>
</html>
