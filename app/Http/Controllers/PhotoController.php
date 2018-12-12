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
use Carbon\Carbon;

class PhotoController extends Controller
{
    // показать одно фото

    public function showPhoto(Request $request) {
    
    $photo = Photo::select('id','name', 'url', 'views', 'user_id', 'description', 'category_id', 'created_at')
           ->where('id', Request()->id)->first();
    
    $published_at = $photo->created_at->format('d.m.Y H:i');
    
    
    $session_user_id = session('user_id');
    $session_cat_id = session('cat_id');
    
    if ($session_user_id) {
    $next = Photo::select('id')->where('id','<', $photo->id)->where('user_id', $session_user_id)->orderby('id', 'desc')->limit(1)->first();
    $previous = Photo::select('id')->where('id','>', $photo->id)->where('user_id', $session_user_id)->limit(1)->first();
    } else if ($session_cat_id) {
    $next = Photo::select('id')->where('id','<', $photo->id)->where('category_id', $session_cat_id)->orderby('id', 'desc')->limit(1)->first();
    $previous = Photo::select('id')->where('id','>', $photo->id)->where('category_id', $session_cat_id)->limit(1)->first();
    } 
    else {
    $next = Photo::select('id')->where('id','<', $photo->id)->orderby('id', 'desc')->limit(1)->first();
    $previous = Photo::select('id')->where('id','>', $photo->id)->limit(1)->first();    
    };
        
    
    
    //dd($next->id);
    
    $comments = Comment::select('id','text', 'user_id','created_at', 'updated_at')
                ->where('photo_id', Request()->id)->orderby('id')->get();
    
    $photo->views += 1;
    $photo->save();
    
    $image = new SimpleImage('photos/' . $photo->user_id . '/'.$photo->url);
    
    $exposureModes = [
        '0' => 'n/a',
        '1' => 'M',
        '2' => 'P',
        '3' => 'AV(A)',
        '4' => 'TV(S)',
        '5' => 'Creative (Slow speed)',
        '6' => 'Action (High speed)', 
        '7' => 'портрет', 
        '8' => 'пейзаж', 
        '9' => 'Bulb',
    ];
    
        $exif = $image->getExif();
    
        if (!isset($exif['Model'])) $exif['Model'] = '';
        if (!isset($exif['FocalLength'])) $exif['FocalLength'] = '';
        if (!isset($exif['ExposureTime'])) $exif['ExposureTime'] = '';
        if (!isset($exif['ExposureBiasValue'])) $exif['ExposureBiasValue'] = '0';
        if (!isset($exif['FNumber'])) $exif['FNumber'] = '';
        if (!isset($exif['ISOSpeedRatings'])) $exif['ISOSpeedRatings'] = '';
        if (!isset($exif['ExposureProgram'])) $exif['ExposureProgram'] = '';       
        if (!isset($exif['Software'])) $exif['Software'] = '';
    
        if ($f = $exif['FocalLength']) {
            $tmp = explode('/', $f);
            if ($tmp[1]) $exif['FocalLength'] = $tmp[0]/$tmp[1];
        }
        
        if ($a = $exif['FNumber']) {
            $tmp = explode('/', $a);
            if ($tmp[1]) $exif['FNumber'] = $tmp[0]/$tmp[1];
        }
        
        if ($e = $exif['ExposureBiasValue']) {
            $tmp = explode('/', $e);
            if ($tmp[1]) $exif['ExposureBiasValue'] = round($tmp[0]/$tmp[1], 2);
        }
        
        if ($m = $exif['ExposureProgram']) {
            $exif['ExposureProgram'] = $exposureModes[$exif['ExposureProgram']];
        }
        
    //dump($exif);
    //dump($session_user_id);
//    dump($session_cat_id);
    
    
    return view('photo', ['photo' => $photo,  'comments' => $comments,  'next' => $next, 'previous' => $previous, 'published_at' => $published_at, 'exif' => $exif]);

    }
    
    public function commentsList() {
        
        $comments = Comment::select()->orderby('id', 'desc')->paginate(20);
        
        session(['user_id' => null]);
        session(['cat_id' => null]);
        
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
           'file' => 'required|file|image|max:16384'
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
                $photo->description = $request->description;
                $photo->user_id = Auth::user()->id;
                $photo->url = $newfile;
                $photo->save();
                
                $image = new SimpleImage();
                $dst = public_path() . '/photos/' . Auth::user()->id . '/' . $newfile;
                $dst1 = public_path() . '/photos/' . Auth::user()->id . '/_' . $newfile;
                $image->fromFile($dst);
                
                if ($image->getHeight()>1200 or $image->getWidth()>1200) {
                    $image->bestFit(1200, 1200);
                }
                $image->toFile($dst);
                
                $image->fromFile($dst);
                $image->bestFit(300,300);
                $image->toFile($dst1);
                
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
    
    
   public function rebuildPreviews() {
   
       $photo = Photo::select()->get();
       dump($photo);
       
       foreach($photo as $p) {
        echo "<pre>$p->url / $p->user_id\r\n</pre>";
                $image = new SimpleImage();
                $dst = public_path() . '/photos/' . $p->user_id . '/' . $p->url;
                $dst1 = public_path() . '/photos/' . $p->user_id . '/_' . $p->url;
                $image->fromFile($dst);
                $image->bestFit(300, 300);
                $image->toFile($dst1);
        
       }
   }
    
}
