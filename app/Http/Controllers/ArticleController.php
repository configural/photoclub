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
        $article = \App\Article::firstOrCreate(['id' => $request->id]);
        $article->name = $request->name;
        $article->description = $request->description;
        
        // summernote start
        $detail = $request->text;
        libxml_use_internal_errors(true);
        $dom = new \domdocument();
        $dom->loadHtml($detail, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        
        
        $nodeHead=$dom->createElement("head");
        $nodeMeta=$dom->createElement('meta');
        $dom->insertBefore($nodeHead, $dom->firstChild);
        $nodeMeta->setAttribute ("http-equiv","Character");
        $nodeMeta->setAttribute ("content","ISO-8859-1");
      
        $nodeHead->appendChild($nodeMeta);
        $nodeMeta=$dom->createElement('meta');
        $nodeMeta->setAttribute ("http-equiv","Content-Type");
        $nodeMeta->setAttribute ("content","text/html; charset=ISO-8859-1");
      
        $nodeHead->appendChild($nodeMeta);
        
        $images = $dom->getElementsByTagName('img');
        
        
        

        foreach ($images as $count => $img) {
            $data = $img->getAttribute('src');
            
            if (str_contains($data, 'base64')) {

                list($type, $data) = explode(';', $data);
                list(, $data)      = explode(',', $data);

                $data = base64_decode($data);

                $image_name= $request->id . "_" . time().$count.'.png';
                @mkdir('images/' . '/' . $article->id);
                $path = 'images/' .  $article->id . "/" . $image_name;

                file_put_contents($path, $data);

                $img->removeAttribute('src');
                $img->setAttribute('src', url('images/') . '/' . $article->id . "/" . $image_name);
           }
        }
     $detail = $dom->savehtml();
     $detail = strip_tags($detail, "<p><a><img><br><h1><h2><h3><h4><h5><h6><div><span><table><tr><td><thead><tbody><span><strong><b><i><ul><ol><li><blockquote><code>");
        // summernote finish

        mb_substitute_character(0x20); // убираем непечатные символы
        $article->text = mb_convert_encoding($detail, 'utf-8');
        
        /*$library->text = str_replace(".?", ".", $library->text);
        $library->text = str_replace("\n?", "\n", $library->text);
        $library->text = str_replace("\r?", "\r", $library->text);
        */
       // dump($library);
        
        $article->save();
        
    
         return view('article', ['article' => $article]);
        }
    
    
}
