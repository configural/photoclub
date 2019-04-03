<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\User;
use App\Photo;
use DB;
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
    public function index(Request $request)
    {
        $cat_id = $request->id;
        

        $cats_list = DB::table('categories')
                ->leftjoin('photos', 'photos.category_id', '=', 'categories.id')
                ->select('categories.name', 'categories.id')
                ->groupBy('categories.id')->get();

        
        if ($cat_id) {
            $photos = Photo::select()->where('category_id', $cat_id)->orderby('id', 'desc')->paginate(20);
            $cat_name = \App\Category::find($cat_id)->name;
            $cat_description = \App\Category::find($cat_id)->description;
            
            session(['cat_id' => $cat_id]);
        } else {
            $photos = Photo::select()->orderby('id', 'desc')->paginate(20);
            $cat_name = "Фотоклуб Артема Кашканова";
            $cat_description = "Цель проекта – конструктивное общение на фототемы, обсуждение присланных фотографий. Нам без разницы, какой у вас фотоаппарат и объектив. Если вам есть, что показать – присоединяйтесь, будем рады вас видеть среди участников Фотоклуба!";
            session(['cat_id' => null]);
        }
        
        session(['user_id' => null]);
        session(['camera' => null]);

        
        $session_user_id = session('user_id');
        $session_cat_id = session('cat_id');
        
        //dump($session_user_id);
        //dump($session_cat_id);


        
        return view('welcome', ['photos' => $photos, 'cats_list' => $cats_list, 'cat_name' => $cat_name, 'cat_description' => $cat_description ]);
    }


    public function home()
    {
           
           $photos = Photo::select()->where('user_id', Auth::user()->id)->orderby('id', 'desc')->paginate(20);
           $user = User::find(Auth::user()->id);
           
           session(['user_id' => Auth::user()->id]);
           session(['camera' => null]);
           
           $session_user_id = session('user_id'); 
           
          // dump($session_user_id);
           
           return view('home', ['photos' => $photos, 'user' => $user]);
           
    }


}
