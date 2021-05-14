<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
    protected $fillable = ['text', 'topic_id'];

    function user() {
        return $this->hasOne('\App\User', 'id', 'user_id');
    }
    
    function topic()
    {
        return $this->hasOne('\App\Topic', 'id', 'topic_id');
    }
    
}
