<div class="nav-body">
  <ul class="nav nav-tabs">
    
    @empty($id) <!--ホーム画面や主要ページのとき(idを受け取ってないとき)-->
      <li class="nav-item">
        <a class="nav-link active" href="{{ route('home') }}">主要</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/articles/tags/1">国内</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/articles/tags/2">国際</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/articles/tags/3">経済</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/articles/tags/4">エンタメ</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/articles/tags/5">スポーツ</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/articles/tags/5">IT</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/articles/tags/6">科学</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/articles/tags/7">ライフ</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/articles/tags/8">地域</a>
      </li>
    @else
      <li class="nav-item">
      <a class="nav-link" href="{{ route('home') }}">主要</a>
    </li>
     <li class="nav-item">
      <a class="nav-link
        <?php  //idを受けとったら、activeをクラスに入れる
          if ($id == 1){
            echo 'active"';
          }else{
            echo '"';
          }
        ?>
        href="/articles/tags/1">国内
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link
        <?php
          if ($id == 2){
            echo 'active"';
          }else{
            echo '"';
          }
        ?>
        href="/articles/tags/2">国際
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link
        <?php
          if ($id == 3){
            echo 'active"';
          }else{
            echo '"';
          }
        ?>
        href="/articles/tags/3">経済
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link
        <?php
          if ($id == 4){
            echo 'active"';
          }else{
            echo '"';
          }
        ?>
        href="/articles/tags/4">エンタメ
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link
        <?php
          if ($id == 5){
            echo 'active"';
          }else{
            echo '"';
          }
        ?>
        href="/articles/tags/5">スポーツ
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link
        <?php
          if ($id == 6){
            echo 'active"';
          }else{
            echo '"';
          }
        ?>
        href="/articles/tags/6">IT
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link
        <?php
          if ($id == 7){
            echo 'active"';
          }else{
            echo '"';
          }
        ?>
        href="/articles/tags/7">科学
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link
        <?php
          if ($id == 8){
            echo 'active"';
          }else{
            echo '"';
          }
        ?>
        href="/articles/tags/8">ライフ
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link
        <?php
          if ($id == 9){
            echo 'active"';
          }else{
            echo '"';
          }
        ?>
        href="/articles/tags/9">地域
      </a>
    </li>
    @endempty
  </ul>
</div>