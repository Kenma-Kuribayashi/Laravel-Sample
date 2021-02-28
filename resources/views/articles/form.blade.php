<div class="form-group">
  {!! Form::label('title', 'タイトル:') !!}
  {!! Form::text('title', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
  {!! Form::label('body', '本文:') !!}
  {!! Form::textarea('body', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
  {!! Form::label('published_at', '記事の公開日:') !!}
  {!! Form::input('date', 'published_at', $published_at, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
  {!! Form::label('tags', 'タグ:') !!}
  {!! Form::select('tags[]', $tag_lists, null, ['class' => 'form-control', 'multiple']) !!}
  <?php // Form::select('選択したタグを入れる配列', タグの配列, null, [divタグのオプション]) ?>
</div>
 
<div class="form-group">
  {!! Form::submit($submitButton, ['class' => 'btn btn-primary form-control']) !!}
</div>