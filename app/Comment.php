<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Comment extends Model 
{
    //
      use SoftDeletes;
            
        protected $fillable = [
        'user_id', 'photo_id', 'text'
    ];
        
        protected $dates = ['deleted_at'];
        

    public function bbCode($text){

        $text = preg_replace('/\[(\/?)(b|i|u|s)\s*\]/', "<$1$2>", $text);
        $text = preg_replace('/\[code\]/', '<pre><code>', $text);
        $text = preg_replace('/\[\/code\]/', '</code></pre>', $text);
        $text = preg_replace('/\[(\/?)quote\]/', "<$1blockquote>", $text);
        $text = preg_replace('/\[(\/?)quote(\s*=\s*([\'"]?)([^\'"]+)\3\s*)?\]/', "<$1blockquote>Цитата $4:", $text);
        $text = preg_replace('/\[url\](?:http:\/\/)?([a-z0-9-.]+\.\w{2,4})\[\/url\]/', "<a href=\"http://$1\">$1</a>", $text);
        $text = preg_replace('/\[url\s?=\s?([\'"]?)(?:http:\/\/)?([a-z0-9-.]+\.\w{2,4})\1\](.*?)\[\/url\]/', "<a href=\"http://$2\">$3</a>", $text);
        $text = preg_replace('/\[img\s*\]([^\]\[]+)\[\/img\]/', "<p><img src='$1'/></p>", $text);
        $text = preg_replace('/\[img\s*=\s*([\'"]?)([^\'"\]]+)\1\]/', "<p><img src='$2'/></p>", $text);
    
        return $text;
    
    }
            
        
    public function user() {
         
            return $this->hasOne('\App\User', 'id', 'user_id');
        }
    
        
    public function photo() {
         
            return $this->hasOne('\App\Photo', 'id', 'photo_id');
        }
        
}
