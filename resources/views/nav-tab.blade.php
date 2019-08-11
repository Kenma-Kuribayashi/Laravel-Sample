<div class="nav-body">
  <ul class="nav nav-tabs">
    
    @empty($tagname) <!--ホーム画面や主要ページのとき(idを受け取ってないとき)-->
      <li class="nav-item">
        <a class="nav-link active" href="/articles">主要</a>
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
        <a class="nav-link" href="/articles/tags/IT">IT</a>
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
      <a class="nav-link" href="/articles">主要</a>
    </li>
     <li class="nav-item">
      <a class="nav-link
        <?php  //idを受けとったら、activeをクラスに入れる
          if ($tagname == "国内"){
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
          if ($tagname == "国際"){
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
          if ($tagname == "経済"){
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
          if ($tagname == "エンタメ"){
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
          if ($tagname == "スポーツ"){
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
          if ($tagname == "IT"){
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
          if ($tagname == "科学"){
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
          if ($tagname == "ライフ"){
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
          if ($tagname == "地域"){
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