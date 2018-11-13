<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use App\Photo;
use App\Category;
use Auth;
use DB;


class UserController extends Controller
{
    //  показать фотки конкретного автора

    public function userPhotos (Request $request) {

        $user = User::where('id', $request->id)->first();

/*
SELECT `categories`.`id`, `categories`.`name`, count(`photos`.`id`) FROM 
`categories`
left join `photos` ON
`photos`.`category_id`=`categories`.`id`
WHERE `photos`.`user_id`=3
GROUP BY `categories`.`id`
 */        
        
        $cats_list = DB::table('categories')
                ->leftjoin('photos', 'photos.category_id', '=', 'categories.id')
                ->select('categories.name', 'categories.id')
                ->where('photos.user_id', $user->id)
                ->where('deleted_at', NULL)
                ->groupBy('categories.id')->get();
                
        
        
        
        if ($request->cat_id) {
            $photo = Photo::where('user_id', $request->id)->where('category_id', $request->cat_id)->orderBy('id', 'desc')->paginate(12);
        }
            
        else {
            $photo = Photo::where('user_id', $request->id)->orderBy('id', 'desc')->paginate(12);
        
        }
        
        return view('user', ['user' => $user, 'photo' => $photo, 'cats_list'=>$cats_list]);

    }

    // показать список пользователей
    public function users () {

        $users = User::select('id', 'name')
                ->where('name', '<>', '')
                ->orderby('name')
                ->paginate(200);

        return view('users', ['users' => $users]);
    }


    // показать форму редактирования деталей профиля
    public function editProfile () {

        return view('editprofile', ['user' => Auth::User()]);
    }


    // сохранение изменений в профиле
    public function storeProfile(Request $request) {

           $this->validate($request, [
           'name' => 'required|max:255',
           'email' => 'email|max:255'
           ]);

           $data = $request->all();
           $user = User::find(Auth::user()->id);
           $user->fill($data);
           $user->save();

           return redirect(url('/home'));


    }




}
