<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Project;

class DashboardController extends Controller
{
    public function index()
    {
        $name = auth()->user()->name;
        // dd($name);

        $projects = Project::All();
         // dd($projects);

        $projectsN = $projects->count();

        return view('admin.dashboard', compact('name', 'projectsN'));
    }

}
