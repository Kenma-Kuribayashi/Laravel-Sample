<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="nav-container">
    <!-- ブランド表示 -->
    <a class="navbar-brand" href="{{ route('home') }}">Sampleニュース</a>
 
    <!-- スマホやタブレットで表示した時のメニューボタン -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
 
    <!-- メニュー -->
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <!-- 右寄せメニュー -->
      <ul class="navbar-nav">
        @auth
          <!-- ログインしている時のメニュー -->
          <li class="nav-item">
            <a class="nav-link" href="#">ユーザー一覧</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/tags">タグ一覧</a>
          </li>
 
        <!-- ドロップダウンメニュー -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            {{ Auth::user()->name }}<span class="caret"></span>
          </a>
 
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="#"
              onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
            >
              Logout
            </a>
 
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
            </form>
          </div>
        </li>
        @endauth
      </ul>
    </div>
  </div>
</nav>