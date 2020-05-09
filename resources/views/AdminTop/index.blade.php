@extends('layout')
 
@section('content')

<div>ユーザー一覧</div>

@foreach ($users as $user)

<div>・{{ $user->getName() }}</div>

@if($user->isContributor())
<div>○</div>
@else
<a href="/admin/{{ $user->getId() }}/register" >投稿者登録する</a>
@endif

    
@endforeach

{{-- <div class="container-fluid">
<div class="row flex-xl-nowrap">
<div class="col-12 col-md-3 col-xl-2 bd-sidebar">
  {{-- <form class="bd-search d-flex align-items-center"> --}}
    {{-- <span class="algolia-autocomplete" style="position: relative; display: inline-block; direction: ltr;">
      <input type="search" class="form-control ds-input" id="search-input" placeholder="Search..." aria-label="Search for..." autocomplete="off" data-siteurl="#" data-docs-version="4.2" spellcheck="false" role="combobox" aria-autocomplete="list" aria-expanded="false" aria-owns="algolia-autocomplete-listbox-0" dir="auto" style="position: relative; vertical-align: top;">
      <pre aria-hidden="true" style="position: absolute; visibility: hidden; white-space: pre; font-family: -apple-system, system-ui, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, &quot;Noto Sans&quot;, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; font-size: 16px; font-style: normal; font-variant: normal; font-weight: 400; word-spacing: 0px; letter-spacing: normal; text-indent: 0px; text-rendering: auto; text-transform: none;"></pre>
      <span class="ds-dropdown-menu" role="listbox" id="algolia-autocomplete-listbox-0" style="position: absolute; top: 100%; z-index: 100; display: none; left: 0px; right: auto;">
        <div class="ds-dataset-1"></div>
      </span>
    </span>
    <button class="btn btn-link bd-search-docs-toggle d-md-none p-0 ml-3" type="button" data-toggle="collapse" data-target="#bd-docs-nav" aria-controls="bd-docs-nav" aria-expanded="false" aria-label="Toggle docs navigation"><svg xmlns="#" viewBox="0 0 30 30" width="30" height="30" focusable="false"><title>Menu</title><path stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-miterlimit="10" d="M4 7h22M4 15h22M4 23h22"></path></svg>
    </button>
</form> --}}

{{-- <nav class="collapse bd-links" id="bd-docs-nav">
  <div class="bd-toc-item">
    <a class="bd-toc-link" href="#">Bootstrap 入門</a>
    <ul class="nav bd-sidenav">
      <li>
      <a href="#">
          はじめに
      </a></li><li>
      <a href="#">
          ダウンロード

      </a></li><li>
      <a href="#">
          ファイル構成

      </a></li><li>
      <a href="#">
          ブラウザとデバイス

      </a></li><li>
      <a href="#">
          JavaScript

      </a></li><li>
      <a href="#">
          テーマ

      </a></li><li>
      <a href="#">
          ビルドツール

      </a></li><li>
      <a href="#">
          Webpack

      </a></li><li>
      <a href="#">
          アクセシビリティ

      </a></li>
    </ul>
  </div>
</nav>

</div>
</div>
</div> --}}
 


@endsection