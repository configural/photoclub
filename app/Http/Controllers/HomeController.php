<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\User;
use App\Photo;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
     //  $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $photos = Photo::select()->orderby('id', 'desc')->paginate(20);


        return view('welcome', ['photos' => $photos ]);
    }


    public function home()
    {

           $photos = Photo::select()->where('user_id', Auth::user()->id)->orderby('id', 'desc')->paginate(20);
           
           return view('home', ['photos' => $photos]);
           
    }


}
