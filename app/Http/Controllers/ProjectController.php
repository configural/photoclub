<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;

class ProjectController extends Controller
{
    //
    function index($slug) {
        $project = \App\Project::where('slug', $slug)->orWhere('id', $slug)->first();
        if (isset($project->id)) {
        $photos = \App\Photo::select('photos.*')
                ->join('photos2project', 'photos2project.photo_id', '=', 'photos.id')
                ->join('projects', 'projects.id', '=', 'photos2project.project_id')
                ->where('projects.id', '=', $project->id)
                ->orderby('photos.created_at', 'desc')
                ->paginate(12);
       
        return view('project', ['project'=> $project, 'photos' => $photos]);
        } else {
            echo "проект не найден";
        }
    }
    
    function save(Request $request) {
        if ($request->id) {
            $project = \App\Project::find($request->id);
        }
        else {
            $project = new \App\Project();
        }
        $project->fill($request->all());
        $project->user_id = Auth::user()->id;
        $project->save();
        //dump($project);
        return redirect(url('/projects'));
            
    }
}
