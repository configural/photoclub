<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use App\Photo;
use Auth;


class UserController extends Controller
{
    //  показать фотки конкретного автора

    public function userPhotos (Request $id) {

        $user = User::where('id', Request()->id)->first();
        $photo = Photo::where('user_id', Request()->id)->orderBy('id', 'desc')->paginate(12);
        return view('user', ['user' => $user, 'photo' => $photo]);

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
