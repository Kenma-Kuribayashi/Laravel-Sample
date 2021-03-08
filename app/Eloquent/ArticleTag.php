<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;

class ArticleTag extends Model
{
    protected $table = 'article_tag';

    /**
     * 複数代入する属性
     *
     * @var array
     */
    protected $fillable = ['article_id', 'tag_id'];

    public function article()
    {
        return $this->belongsTo('App\Eloquent\Article');
    }

    public function tag()
    {
        return $this->belongsTo('App\Eloquent\Tag');
    }
}