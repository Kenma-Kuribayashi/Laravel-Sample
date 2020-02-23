<div class="nav-body">
  <ul class="nav nav-tabs">
    
    @empty($tag_name) <!--ホーム画面や主要ページのとき(idを受け取ってないとき)-->
      <li class="nav-item">
        <a class="nav-link active" href="/articles">主要</a>
      </li>
      @foreach($tag_lists as $tag)
        <li class="nav-item">
          <a class="nav-link" href="/articles/tags/{{ $tag }}">{{ $tag }}
          </a>
        </li>
      @endforeach
    @else
      <li class="nav-item">
        <a class="nav-link" href="/articles">主要</a>
      </li>
      @foreach($tag_lists as $tag)
        <li class="nav-item">
          <!--//$tag_nameと同じタグのクラスにactiveを入れる-->
          <a class="nav-link {{ $tag_name === $tag ? 'active' : '' }}" 
            href="/articles/tags/{{ $tag }}">{{ $tag }}
          </a>
       </li>
      @endforeach
    @endempty
  </ul>
</div>