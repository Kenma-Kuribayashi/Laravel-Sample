<?php

namespace App\Services;

use App\Eloquent\Tag;


class GetTagList {

  
  public function get_tag_list() {

    //nameキーとidキーを配列に入れて全て取り出す
    return Tag::orderBy('id')->pluck('name', 'id'); 
      
  }

}


 ?>