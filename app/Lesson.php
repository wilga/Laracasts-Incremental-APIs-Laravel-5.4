<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{

    protected $fillable = ['title', 'body', 'some_bool'];

    public function tags()
    {
    	return $this->belongsToMany('App\Tag');
    }

}
