<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;


class Tag extends Model
{
    /**
     * モデルのタイムスタンプを更新するかの指示
     *
     * @var bool
     */
    public $timestamps = false;

    protected $fillable = ['name'];

    public function articles()
    {
        return $this->belongsToMany(Article::class)->withTimestamps(); //belongsToManyメソッドはArticleモデルと多対多の構造をつくる。
    }
}
