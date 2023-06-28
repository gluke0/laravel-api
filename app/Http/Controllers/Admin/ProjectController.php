<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Admin\Project;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Admin\Category;
use App\Models\Admin\Technology;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::All();

        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Project $project)
    {
        $categories = Category::All();
        $technologies = Technology::All();

        return view('admin.projects.create', compact('project', 'categories', 'technologies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProjectRequest $request)
    {
        
        $form_data = $request->validated();

        $form_data = $request->All();

        $slug = Project::addSlug($request->title);

        $form_data['slug'] = $slug;

        if($request->hasFile('image')){
            $path = Storage::disk('public')->put('project_images', $request->image);

            $form_data['image'] = $path;
        }

        $new_project = new Project();
        $new_project->fill($form_data);
        $new_project->save();
        
        // dd($request);

        if($request->has('technologies')){
            $new_project->technologies()->attach($request->technologies);
        }


        return redirect()->route('admin.projects.index')->with('success', "A new project has been added");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $categories = Category::All();
        $technologies = Technology::All();

        return view('admin.projects.edit', compact('project', 'categories', 'technologies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        
        $form_data = $request->validated();

        $form_data = $request->All();

        $slug = Project::addSlug($request->title);

        $form_data['slug'] = $slug;

        if($request->hasFile('image')){
            $path = Storage::disk('public')->put('project_images', $request->image);
            if( $project->image ){
                Storage::delete($project->image);
            }
            $form_data['image'] = $path;
        }

        $project->update($form_data);

        if($request->has('technologies')){
            $project->technologies()->sync($request->technologies);
        } else {
            $project->technologies()->sync([]);
        }
        
        return redirect()->route('admin.projects.index')->with('success', "The project $project->title has been edited");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {

        $project->technologies()->sync([]);

        if($project->image){
            Storage::delete($project->image);
        }

        $project->delete();

        return redirect()->route('admin.projects.index')->with('success', "The project $project->title has been deleted");
    }
}
