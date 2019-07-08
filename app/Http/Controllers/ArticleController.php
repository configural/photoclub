<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Article;

class ArticleController extends Controller
{
    //
    public function Show(Request $request) {
        $id = $request->id;
        $article = Article::find($id);
        return view('article', ['article' => $article]);        
    }
    
    
    public function Add() {
        return view('addarticle');        
    }
    
    public function Edit(Request $request) {
        $id = $request->id;
        $article = Article::find($id);
        return view('editarticle', ['article' => $article]);        
    }
    
    public function Store(Request $request) {
    $this->validate($request, [
              "name" => "required:max256",
              "description" => "max:2048",
              ]);
          
          $data = $request->all();
          $article = Article::firstOrCreate(['id' => $request->id]);
          
          $article->fill($data);
          
          $article->save();
          
         return view('article', ['article' => $article]);
            }
    
    
}
