<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    //
    protected $fillable = ['slug', 'name', 'description', 'active', 'user_id', 'is_private'];
    
    function photos() {
        return $this->belongsToMany('\App\Photo', 'photos2project', 'project_id', 'photo_id');
    }
    
    function user() {
        return $this->hasOne('\App\User', 'id', 'user_id');
    }
    
    
}
