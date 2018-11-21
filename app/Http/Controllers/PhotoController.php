<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use App\Http\Requests;
use App\Photo;
use App\User;
use App\Comment;
use App\Category;
use claviska\SimpleImage;

class PhotoController extends Controller
{
    // показать одно фото

    public function showPhoto(Request $request) {
    
    $photo = Photo::select('id','name', 'url', 'views', 'user_id', 'description', 'category_id')
           ->where('id', Request()->id)->first();
    
    $comments = Comment::select('id','text', 'user_id','created_at', 'updated_at')
                ->where('photo_id', Request()->id)->orderby('id')->get();
    return view('photo', ['photo' => $photo,  'comments' => $comments,  ]);

    }
    
    public function commentsList() {
        
        $comments = Comment::select()->paginate(20);
        
        return view('comments', ["comments" => $comments]);
        
    }
    
    public function addPhoto() {
        
        $categories = Category::select('id', 'name')->where('active', 1)->get();
        return view('addphoto', ['categories' => $categories]);
    }
    
    public function editPhoto(Request $request) {
        $this->validate($request, [
            'id' => 'integer' 
        ]);
        
        $photo = Photo::find($request->id);
        $categories = Category::select('id', 'name')->where('active', 1)->get();
        
        return view('editphoto', ['photo' => $photo, 'categories' => $categories]);
    }
    
    public function storePhoto(Request $request) {
          $this->validate($request, [
              "name" => "required:max256",
              "description" => "max:2048"
          ]);
          
          $data = $request->all();
          $photo = Photo::find($request->id);
          $photo->fill($data);
          $photo->save();
          
          return redirect('home');
          
          
    }
    
    
    public function uploadPhoto(Request $request)     {
           $this->validate($request, [
           'name' => 'required|max:255',
           'description' => 'email|max:2048',
           'file' => 'mimes:jpeg,png'
            
           ]);
        
        if($request->isMethod('post')){
            if($request->hasFile('file')) {
                $newfile = "photo".time().rand(1000,9999).".jpg";
                $file = $request->file('file');
                
                $file->move(public_path() . '/photos/' . Auth::user()->id. '/', $newfile);
                
               //dd($file);
                
                
                $photo = new Photo;
                $photo->name = $request->name;
                $photo->category_id = $request->category_id;
                $photo->user_id = Auth::user()->id;
                $photo->url = $newfile;
                $photo->save();
                
                $image = new SimpleImage();
                $dst = public_path() . '/photos/' . Auth::user()->id . '/' . $newfile;
                $image->fromFile($dst);
                
                if ($image->getHeight()>1200 or $image->getWidth()>1200) {
                    $image->bestFit(1200, 1200);
                }
                
                $image->toFile($dst);
                
                
                return redirect('home');
            }
        }
        
        
        
    }
    
    public function deletePhoto(Request $request) {
        
        $photo = Photo::find($request->id);
        
        if ($photo->user_id == Auth::user()->id || Auth::user()->admin) {
                    $photo->delete();
                    Comment::select()->where('photo_id', $request->id)->delete();

        }
        return redirect('/home'); 
        
    }
    
    
    
    public function addComment(Request $request) {
           $this->validate($request, [
           'text' => 'required|max:2048',
           ]);
           
           $data = $request->all();
           $comment = new Comment;
           $comment->fill($data);
           $comment->save();
           
           return redirect()->back();    
    }
    
    public function editComment(Request $request) {
        
        $comment = Comment::find($request->id);
        return view('editcomment', ['comment' => $comment]);
        
    }
    
    public function updateComment(Request $request) {
        
           $this->validate($request, [
           'text' => 'required|max:2048',
           ]);
        
        $data = $request->all();
        $comment = Comment::find($request->id);
        
        if (Auth::user()->id == $comment->user_id || Auth::user()->admin) {
            
            $comment->fill($data);
            $comment->save();
            
            return redirect(url('photo') . '/' . $comment->photo_id . '#' . $comment->id );
            
        }
        
        
    }
    
    
    public function deleteComment(Request $request) {
        
        $comment = Comment::find($request->id)->delete();
        
        return redirect()->back(); 
        
    }
    
    
    
    
}
