<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;


class User extends Authenticatable
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'avatar', 'description'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


   
 public function photos() {
    return $this->hasMany('\App\Photo', 'user_id', 'id');
}  

        public function getStatus() {
            return $this->hasOne('\App\Status', 'id', 'status');
        }
 function has_projects() {
    return \App\Project::where('user_id', $this->id)->count();
}
        
        
        }

