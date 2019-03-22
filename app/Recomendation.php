<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recomendation extends Model
{
    //
       protected $fillable = [
        'user_id', 'photo_id', 'k', 'o', 't'
    ];
}
