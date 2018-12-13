<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Photo;
use App\User;
use DB;

class StatController extends Controller
{
    //
    
    public function ourStat() {
        
        $users = DB::select('select `users`.`name` as `name`, `photos`.`user_id`, count(`photos`.`id`) as `count` from `photos`, `users` where `users`.`id` = `photos`.`user_id` group by `user_id` having `count`>1 order by `count` desc');
        $cameras = DB::table('photos')->select(DB::raw('distinct `user_id`, `Model`, count(distinct `user_id`) as `count`'))
                ->where('Model','<>', '')
                ->groupBy('Model')
                ->orderBy('count', 'desc')
                ->get();
        $modes = DB::table('photos')->select(DB::raw('`ExposureProgram`, count(`ExposureProgram`) as `count`'))
                ->where('ExposureProgram', '>', '0')                
                ->where('ExposureProgram', '<', '10')                
                
                ->groupBy('ExposureProgram')->orderBy('count', 'desc')->get();
        
        $modesList = ['0' => 'n/a', 
                      '1' => 'Ручной',
                      '2' => 'Программная экспозиция',
                      '3' => 'Приоритет диафрагмы',
                      '4' => 'Приоритет выдержки',
                      '5' => 'Авто',
                      '6' => 'Спорт',
                      '7' => 'Портрет',
                      '8' => 'Пейзаж',
                      '9' => 'Bulb',
            '8176' => ''
                      ];

        
        return view('stat', ['users' => $users, 'cameras' => $cameras, 'modes' => $modes, 'modesList' => $modesList]);
        
        }
        
        
    }
    

