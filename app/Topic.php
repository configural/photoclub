<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    //
    protected $fillable = ['user_id', 'forum_id', 'name', 'text', 'active'];
    
    function user() {
        return $this->hasOne('\App\User', 'id', 'user_id');
    }
    
    function forum() {
        return $this->hasOne('\App\Forum', 'id', 'forum_id');
    }
    
    static function last_post($id) {
        $posts_count = \App\Post::where('topic_id', $id)->count();
        $page = ceil($posts_count/10);
        
        $last_post = \App\Post::orderBy('id', 'desc')->first();
        echo "<a href='topic/" . $id . "?page=" . $page . "#" . $last_post->id ."'>" . $last_post->user->name . "<br>" . \Club::normal_date($last_post->updated_at). "</a>";
            }
    
}
