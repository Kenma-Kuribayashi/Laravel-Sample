<?php
  $tag_defaults = array("国内", "国際", "経済", "エンタメ", "スポーツ", "IT", "科学", "ライフ", "地域");
?>

<div class="nav-body">
  <ul class="nav nav-tabs">
    
    @empty($tagname) <!--ホーム画面や主要ページのとき(idを受け取ってないとき)-->
      <li class="nav-item">
        <a class="nav-link active" href="/articles">主要</a>
      </li>
      @foreach($tag_defaults as $tag_default)
        <li class="nav-item">
          <!-- 配列$tag_defaultsから取り出してる -->
          <a class="nav-link" href="/articles/tags/<?php echo $tag_default ?>"><?php echo $tag_default ?></a>
        </li>
      @endforeach
    @else
      <li class="nav-item">
        <a class="nav-link" href="/articles">主要</a>
      </li>
      @foreach($tag_defaults as $tag_default)
        <li class="nav-item">
          <!--//URL経由で送られてきた$tagnameと、配列の$tag_defaultsが同じとき、その同じタグのクラスにactiveをクラスに入れる 三項演算子で表記 echoだとエラー-->
          <a class="nav-link <?php $tagname == $tag_default ? print 'active"' :  print '"'; ?>
            href="/articles/tags/<?php echo $tag_default ?>">
            <?php echo $tag_default ?>
          </a>
       </li>
      @endforeach
    @endempty
  </ul>
</div>