<div class="nav-body">
  <ul class="nav nav-tabs">
    
    @empty($id) <!--ホーム画面や主要ページのとき(idを受け取ってないとき)-->
      <li class="nav-item">
        <a class="nav-link active" href="{{ route('home') }}">主要</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/articles/tags/国内">国内</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/articles/tags/国際">国際</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/articles/tags/経済">経済</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/articles/tags/エンタメ">エンタメ</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/articles/tags/スポーツ">スポーツ</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/articles/tags/スポーツ">IT</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/articles/tags/科学">科学</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/articles/tags/ライフ">ライフ</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/articles/tags/地域">地域</a>
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
        href="/articles/tags/国内">国内
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
        href="/articles/tags/国際">国際
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
        href="/articles/tags/経済">経済
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
        href="/articles/tags/エンタメ">エンタメ
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
        href="/articles/tags/スポーツ">スポーツ
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
        href="/articles/tags/IT">IT
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
        href="/articles/tags/科学">科学
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
        href="/articles/tags/ライフ">ライフ
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
        href="/articles/tags/地域">地域
      </a>
    </li>
    @endempty
  </ul>
</div>