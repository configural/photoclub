<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    //

        protected $fillable = [
        'user_id', 'category_id', 'name', 'description'
    ];

        public function user() {
            
            return $this->hasOne('\App\User', 'id', 'user_id');
        }
        
        public function category() {
            return $this->hasOne('\App\Category', 'id','category_id');
        }
        
}
