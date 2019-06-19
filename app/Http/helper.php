<?php
function delete_form($url, $label = '削除')
{
  $form = Form::open(['method' => 'DELETE', 'url' => $url, 'class' => 'd-inline']);
  $form .= Form::submit($label, ['class' => 'btn btn-danger']);
  $form .= Form::close();
 
  return $form;
}