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
        $text = str_ireplace("[b]", "<strong>", $text);
        $text = str_ireplace("[/b]", "</strong>", $text);

        $text = str_ireplace("[i]", "<i>", $text);
        $text = str_ireplace("[/i]", "</i>", $text);

        $text = str_ireplace("[img]", "<img src='", $text);
        $text = str_ireplace("[/img]", "'>", $text);

    return $text;
    
    }
            
        
    public function user() {
         
            return $this->hasOne('\App\User', 'id', 'user_id');
        }
        
        
}
