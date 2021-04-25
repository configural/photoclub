<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class ProjectController extends Controller
{
    //
    function index($slug) {
        $project = \App\Project::where('slug', $slug)->first();
        
        $photos = \App\Photo::select('photos.*')
                ->join('photos2project', 'photos2project.photo_id', '=', 'photos.id')
                ->join('projects', 'projects.id', '=', 'photos2project.project_id')
                ->where('projects.id', '=', $project->id)
                ->orderby('photos.created_at', 'desc')
                ->paginate(10);
       
        return view('project', ['project'=> $project, 'photos' => $photos]);
        
    }
}
