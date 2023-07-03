<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Admin\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index(Request $request){

        
        // // this is needed to let the select filter works
        // if($request->has('category_id')){
        //     $projects = Project::with('category', 'technologies')->where('category_id', $request->category_id)->paginate(5);
        // } else {
        //     $projects = Project::with('category', 'technologies')->paginate(5);
        // }

        // // // with and get allow me to extract all the data, bewtween brackets, from the db including relationships
        // // // $projects = Project::with('category', 'technologies')->get();

        // // // Laravel helps us with pages, now it separates content in diff pages, 5 projects per page
        // // $projects = Project::with('category', 'technologies')->paginate(5);

        // return response()->json([
        //     'success' => true,
        //     'projects' => $projects,
        // ]);


        $query = Project::with(['category', 'technologies']);

        if($request->has('category_id')){
            $query->where('category_id', $request->category_id);
        }
        if($request->has('technologies_id')){
            $techIds = explode(',', $request->technologies_id);
            $query->whereHas('technologies', function($query) use ($techIds){
                $query->whereIn('id', $techIds);
            });
        }

        $projects = $query->paginate(5);
        return response()->json([
            'success' => true,
            'projects' => $projects,
        ]);
    }

    public function show($slug){
        // this retrieves a "Project" object from the database with the 'category' and 'technologies' relationships preloaded, based on the value of the 'slug' field.
        $project = Project::with('category', 'technologies')->where('slug', $slug)->first();

        if ($project){
            return response()->json([
                'success' => true,
                'project' => $project,
            ]);
        } else {
            return response()->json([
                'success' => false,
                'project' => 'There are no projects',
            ])->setStatusCode(404); 
            // adding the error 404 to the network. Showing the page not-found now it is linked to the right error in the console. Without this it would give a 200 ok message cause it landed correclty on the not-found page
        }
    }

}
