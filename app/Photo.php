<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Photo extends Model
{
    //
      use SoftDeletes;

      
        protected $fillable = [
        'user_id', 'category_id', 'name', 'description', 'Make', 'Model', 
            'FocalLength','ExposureTime','ExposureBiasValue','FNumber','ISOSpeedRatings',
            'ExposureProgram','Software', 'fullsize', 'critic_level',
            'is_private'
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
        
        public function recCount() {
            $K = $this->hasMany('\App\Recomendation')->wherePhotoId($this->id)->whereK(1)->count();
            $O = $this->hasMany('\App\Recomendation')->wherePhotoId($this->id)->whereO(1)->count();
            $T = $this->hasMany('\App\Recomendation')->wherePhotoId($this->id)->whereT(1)->count();
            
            return $K + $O + $T;
            
            
        }
        
        
}
