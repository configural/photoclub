<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use App\Http\Requests;
use App\Photo;
use App\User;
use App\Comment;
use App\Category;
use App\Recomendation;
use claviska\SimpleImage;
use Carbon\Carbon;


class PhotoController extends Controller
{
    // показать одно фото

    public function showPhoto(Request $request) {
    
    $photo = Photo::select()
           ->where('id', Request()->id)->first();
    
    $recK = Recomendation::select('K')->where('photo_id', $photo->id)->where('k', 1)->count();
    $recO = Recomendation::select('O')->where('photo_id', $photo->id)->where('o', 1)->count();
    $recT = Recomendation::select('T')->where('photo_id', $photo->id)->where('t', 1)->count();
    
    $published_at = $photo->created_at->format('d.m.Y H:i');
    
    
    $session_user_id = session('user_id');
    $session_cat_id = session('cat_id');
    $session_camera = session('camera');
    
    if ($session_user_id) {
    $next = Photo::select('id')->where('id','<', $photo->id)->where('user_id', $session_user_id)->orderby('id', 'desc')->limit(1)->first();
    $previous = Photo::select('id')->where('id','>', $photo->id)->where('user_id', $session_user_id)->limit(1)->first();
    } else if ($session_cat_id) {
    $next = Photo::select('id')->where('id','<', $photo->id)->where('category_id', $session_cat_id)->orderby('id', 'desc')->limit(1)->first();
    $previous = Photo::select('id')->where('id','>', $photo->id)->where('category_id', $session_cat_id)->limit(1)->first();
    } else if ($session_camera) {
    $next = Photo::select('id')->where('id','<', $photo->id)->where('Model', $session_camera)->orderby('id', 'desc')->limit(1)->first();
    $previous = Photo::select('id')->where('id','>', $photo->id)->where('Model', $session_camera)->limit(1)->first();
    } else {
    $next = Photo::select('id')->where('id','<', $photo->id)->orderby('id', 'desc')->limit(1)->first();
    $previous = Photo::select('id')->where('id','>', $photo->id)->limit(1)->first();    
    };
        
    
    
    //dd($next->id);
    
    $comments = Comment::select()
                ->where('photo_id', Request()->id)->orderby('id')->get();
    
    if (!Auth::user() or Auth::user()->id != $photo->user_id) 
        {$photo->views += 1;  
        $photo->save();}
    
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
    

   if ($photo->ExposureProgram) $photo->ExposureProgram = $exposureModes[$photo->ExposureProgram];
        
   $critic_levels = ["Автор не хочет критики", "", "Автор хочет критики"];
    
    return view('photo', ['photo' => $photo,  'comments' => $comments,  'next' => $next, 'previous' => $previous, 'published_at' => $published_at, 'recK' => $recK, 'recO' => $recO, 'recT' => $recT, 'critic_levels' => $critic_levels ]);

    }
    
    public function commentsList() {
        
        $comments = Comment::select()->orderby('id', 'desc')->paginate(20);
        
        session(['user_id' => null]);
        session(['cat_id' => null]);
        session(['camera' => null]);
        
        return view('comments', ["comments" => $comments]);
        
    }
    
    public function addPhoto() {
        $limit = Photo::select()->where('created_at', '>=', \Carbon\Carbon::now()->addDays(-10))->where('user_id', Auth::user()->id)->count();
       // dd($limit);
        
        $categories = Category::select('id', 'name')->where('active', 1)->get();
        return view('addphoto', ['categories' => $categories, 'limit' => $limit]);
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
              "description" => "max:2048",
              "fullsize" => "url"
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
           'file' => 'required|file|image|max:16384',
           'fullsize' => 'url'
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
                $photo->fullsize = $request->fullsize;
                $photo->user_id = Auth::user()->id;
                $photo->url = $newfile;
               // $photo->save();
                
                $image = new SimpleImage();
                $dst = public_path() . '/photos/' . Auth::user()->id . '/' . $newfile;
                $dst1 = public_path() . '/photos/' . Auth::user()->id . '/_' . $newfile;
                $image->fromFile($dst);
                
                ///
 $exif = $image->getExif();
    
        if (!isset($exif['Make'])) $exif['Make'] = '';
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
        
/*        if ($m = $exif['ExposureProgram']) {
            $exif['ExposureProgram'] = $exposureModes[$exif['ExposureProgram']];
        }*/
        
        $photo->Make = $exif['Make'];
        $photo->Model = $exif['Model'];
        $photo->FocalLength = $exif['FocalLength'];
        $photo->ExposureTime = $exif['ExposureTime'];
        $photo->ExposureBiasValue = $exif['ExposureBiasValue'];
        $photo->FNumber = $exif['FNumber'];
        $photo->ISOSpeedRatings = $exif['ISOSpeedRatings'];
        $photo->ExposureProgram = $exif['ExposureProgram'];
        $photo->Software = $exif['Software'];   
        $photo->critic_level = $request->critic_level;
        //dump($photo);
        $photo->save();
                ///
                
                if ($image->getHeight()>1440 or $image->getWidth()>1440) {
                    $image->bestFit(1440, 1440);
                }
                $image->toFile($dst,null,90);
                
                $image->fromFile($dst);
                $image->bestFit(300,300);
                $image->toFile($dst1,null,80);
                
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

      public function rebuildExif() {
   
       $photo = Photo::first()->get();
      // dump($photo);
       
       foreach($photo as $p) {
        $image = new SimpleImage('photos/' . $p->user_id . '/'.$p->url);

        $exif = $image->getExif();
    
        if (!isset($exif['Make'])) $exif['Make'] = '';
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
        
/*        if ($m = $exif['ExposureProgram']) {
            $exif['ExposureProgram'] = $exposureModes[$exif['ExposureProgram']];
        }*/
        
        $p->Make = $exif['Make'];
        $p->Model = $exif['Model'];
        $p->FocalLength = $exif['FocalLength'];
        $p->ExposureTime = $exif['ExposureTime'];
        $p->ExposureBiasValue = $exif['ExposureBiasValue'];
        $p->FNumber = $exif['FNumber'];
        if (!is_array($exif['ISOSpeedRatings'])) {$p->ISOSpeedRatings = $exif['ISOSpeedRatings'];}
        else {$p->ISOSpeedRatings = $exif['ISOSpeedRatings'][0];}
        $p->ExposureProgram = $exif['ExposureProgram'];
        $p->Software = $exif['Software'];


        dump($p);
        $p->save();
        
        

        
       }
       echo "done!";
   }
   
   
   public function cameraPhoto(Request $request) {
       //dump($request->model);
       
           $model = $request->model;
           $photos = Photo::select()->where('Model', $request->model)->orderby('id', 'desc')->paginate(20);
           session(['camera' => $model]);
           return view('camera', ['photos' => $photos, 'model' => $model]);
   }
   
}
