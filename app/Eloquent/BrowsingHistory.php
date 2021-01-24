<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;

class BrowsingHistory extends Model
{
    protected $table = 'browsing_history';

    /**
     * 複数代入する属性
     *
     * @var array
     */
    protected $fillable = ['article_id', 'user_id', 'browse_date'];

    public function article()
    {
        return $this->belongsTo('App\Article');
    }

}
