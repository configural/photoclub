<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use App\Photo;
use App\Category;
use Auth;
use DB;
use claviska\SimpleImage;



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
           'email' => 'email|max:255',
           'avatar' => 'image|max:16834'
            
           ]);
           
           //dd($request);
           $avatar = 0;
           
           if($request->isMethod('post')){
                if($request->hasFile('avatar')) {
                    
                $newfile = "avatar.jpg";
                $file = $request->file('avatar');
                $file->move(public_path() . '/photos/' . Auth::user()->id. '/', $newfile);
                $avatar = 1;
                
                
                $image = new SimpleImage();
                $dst = public_path() . '/photos/' . Auth::user()->id. '/avatar.jpg';
                $image->fromFile($dst);
                
                if ($image->getHeight()>400 or $image->getWidth()>400) {
                    $image->bestFit(400, 400);
                }
                
                $image->toFile($dst);
                
                
                
                }
           }
           

           

           $data = $request->all();
           $user = User::find(Auth::user()->id);
           $user->fill($data);
           $user->avatar = $avatar;
           $user->save();

           return redirect(url('/home'));


    }




}
