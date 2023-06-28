<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Admin\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index(){

        // with and get allow me to extract all the data, bewtween brackets, from the db including relationships
        // $projects = Project::with('category', 'technologies')->get();

        // Laravel helps us with pages, now it separates content in diff pages, 5 projects per page
        $projects = Project::with('category', 'technologies')->paginate(5);

        return response()->json([
            'success' => true,
            'projects' => $projects,
        ]);
    }
}
