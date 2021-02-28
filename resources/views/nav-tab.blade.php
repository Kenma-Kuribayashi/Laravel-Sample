<div class="nav-body">
  <ul class="nav nav-tabs">
    
    @empty($tag_id) <!--ホーム画面や主要ページのとき(idを受け取ってないとき)-->
      <li class="nav-item">
        <a class="nav-link active" href="/articles">主要</a>
      </li>
      @foreach($tag_lists as $id => $tag_name)
        <li class="nav-item">
          <a class="nav-link" href="/articles/tags/{{ $id }}">{{ $tag_name }}
          </a>
        </li>
      @endforeach
    @else
      <li class="nav-item">
        <a class="nav-link" href="/articles">主要</a>
      </li>
      @foreach($tag_lists as $id => $tag_name)
        <li class="nav-item">
          <!--//$tag_nameと同じタグのクラスにactiveを入れる-->
          <a class="nav-link {{ $id === $tag_id ? 'active' : '' }}" 
            href="/articles/tags/{{ $id }}">{{ $tag_name }}
          </a>
       </li>
      @endforeach
    @endempty
  </ul>
</div>