<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="nav-container">
    <!-- ブランド表示 -->
    <a class="navbar-brand" href="/articles">Sampleニュース</a>
    <!-- メニュー -->
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <!-- 右寄せメニュー -->
      <ul class="navbar-nav">
        @auth
          <!-- ログインしている時のメニュー -->
          <!--<li class="nav-item">-->
          <!--  <a class="nav-link" href="#">ユーザー一覧</a>-->
          <!--</li>-->
          <li class="nav-item">
              <a href="/browsing_history">閲覧履歴</a>
          <input name="currentUser" value="{{ $currentUser->id }}" hidden>
         </li>
          <li class="nav-item">
             <div class="white nav-name">{{ $currentUser->name }}さん</div>
          </li>
          <li class="nav-item">             
            <a class="white logout-bottom" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
              ログアウト
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
            </form>
          </li>
        @endauth
      </ul>
    </div>
  </div>
</nav>