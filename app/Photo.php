<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;


class Photo extends Model
{
    //
      use SoftDeletes;

      
        protected $fillable = [
        'user_id', 'category_id', 'name', 'description'
    ];
        
        protected $dates = ['deleted_at'];


        public function user() {
            
            return $this->hasOne('\App\User', 'id', 'user_id');
        }
        
        public function category() {
            return $this->hasOne('\App\Category', 'id','category_id');
        }
        
        public function commentsCount() {
            return $this->hasMany('\App\Comment')->wherePhotoId($this->id)->count();
        }
        
}
