<div class="form-group">
  {!! Form::label('title', 'Title:') !!}
  {!! Form::text('title', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
  {!! Form::label('body', 'Body:') !!}
  {!! Form::textarea('body', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
  {!! Form::label('published_at', 'Publish On:') !!}
  {!! Form::input('date', 'published_at', $published_at, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
  {!! Form::label('tags', 'Tags:') !!}
  {!! Form::select('tags[]', $tag_list, null, ['class' => 'form-control', 'multiple']) !!}
</div>
 
<div class="form-group">
  {!! Form::submit($submitButton, ['class' => 'btn btn-primary form-control']) !!}
</div>