<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Club;

use App\Http\Requests;

class TopicController extends Controller
{
    //
    function view($id) {
        $topic = \App\Topic::find($id);
        $posts = \App\Post::where('topic_id', $id)->paginate(10);
        return view('forum_topic', ['topic' => $topic, 'posts' => $posts]);
        
    }
    
    function add_post(Request $request) {
        $post = new \App\Post();
        $post->fill($request->all());
        $post->user_id = Auth::user()->id;
        $post->save();
        $posts = \App\Post::where('topic_id', $post->topic_id)->count();
        $page = ceil($posts / 10);
        return redirect(url('forum/topic/'.$request->topic_id).'?page='. $page . "#" . $post->id);
    }
    
    function save_post(Request $request) {
        $post = \App\Post::where('id', $request->id)->where('user_id', Auth::user()->id)->first();
        if ($post) {
        $post->fill($request->all());
        $post->save();
        $posts = \App\Post::where('topic_id', $post->topic_id)->where('id', '<=', $request->id)->count();
        $page = ceil($posts / 10);
        return redirect(url('forum/topic/'.$post->topic_id).'?page='. $page . "#" . $post->id);
        }
    }
    
    function save_topic(Request $request) {
        $topic = \App\Topic::where('id', $request->id)->where('user_id', Auth::user()->id)->first();
        if ($topic) {
        $topic->fill($request->all());
        $topic->save();
        
        return redirect(url('forum/topic/'.$topic->id) );
        }
    }
    
}
