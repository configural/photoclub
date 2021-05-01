<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    //
    function photos() {
        return $this->belongsToMany('\App\Photo', 'photos2project', 'project_id', 'photo_id');
    }
    
    function user() {
        return $this->hasOne('\App\User', 'id', 'user_id');
    }
    
    
}
