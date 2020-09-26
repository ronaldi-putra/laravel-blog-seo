<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;

    protected $fillable = ['judul','slug','categories_id','content','gambar','user_id'];

    public function category()
    {
        return $this->belongsTo('App\Category','categories_id');
    }

    public function tag()
    {
        return $this->belongsToMany('App\Tag');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
