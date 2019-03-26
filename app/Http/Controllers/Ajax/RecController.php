<?php

namespace App\Http\Controllers\ajax;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Photo;
use App\User;
use App\Recomendation;
use App\Http\Requests;
use App\Http\Controllers\Controller;


class RecController extends Controller
{
    //
    
    function rec(Request $request) {
        
        $user_id = Auth::user()->id;
        $photo_id = $request->photo_id;
        $rec = $request->rec;
        
        $r = Recomendation::firstOrCreate(['user_id' => $user_id, 'photo_id' => $photo_id]);
        $k = $r->k;
        $o = $r->o;
        $t = $r->t;             
        
        switch($rec) {
            case "K": {
                if ($r->k == 0) $r->k = 1;
                $r->save();
                break;
            }
            case "O": {
                if ($r->o == 0) $r->o = 1;
                $r->save();
                break;
            }
            case "T": {
                if ($r->t == 0) $r->t = 1;
                $r->save();
                break;
            }
            default: {break;}
        }
        
        $count_k = Recomendation::select("k")->where("photo_id", $photo_id)->where('k', '1')->count();
        $count_o = Recomendation::select("o")->where("photo_id", $photo_id)->where('o', '1')->count();        
        $count_t = Recomendation::select("t")->where("photo_id", $photo_id)->where('t', '1')->count();        
      
        $kot = ["k" => $count_k, "o" => $count_o, "t" => $count_t];
      
        return $kot;
        
    }
    
}

