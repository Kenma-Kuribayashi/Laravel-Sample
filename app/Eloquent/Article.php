<?php

namespace App\Eloquent;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
  protected $fillable = ['title', 'body','user_id', 'published_at', 'image'];
  protected $dates = ['published_at'];
  
  public function scopePublished($query) {
    $query->where('published_at', '<=', Carbon::now());
  }
  
  public function user() 
  {
    return $this->belongsTo('App\Eloquent\User');
  }
  
  public function tags()
  {
    return $this->belongsToMany('App\Eloquent\Tag')->withTimestamps();
  }
}
