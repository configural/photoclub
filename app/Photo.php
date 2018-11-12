<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    //

        protected $fillable = [
        'user_id', 'category_id', 'name', 'best', 'views'
    ];

        public function user() {
            
            return $this->hasOne('\App\User', 'id', 'user_id');
        }
        
}
