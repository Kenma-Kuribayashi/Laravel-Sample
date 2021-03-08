<?php

namespace App\Eloquent;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Eloquent\Article;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * is_adminに必ずfalseを設定
     *
     * @param
     * @return void
     */
    public function setIsAdminAttribute(bool $value)
    {
        if (config('app.env') === 'testing') {
            $this->attributes['is_admin'] = $value;
            
            return;
        }

        $this->attributes['is_admin'] = 0;
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    public function articles() 
    {
        return $this->hasMany(Article::class);
    }
}
