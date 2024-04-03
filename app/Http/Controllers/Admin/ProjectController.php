<?php

namespace App\Http\Controllers\Admin;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\UpdateProjectRequest;
use App\Http\Requests\StoreProjectRequest;
use App\Models\Technology;
use App\Models\Type;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;


class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::all();
        $types = Type::select('label', 'id')->get();
        return view('admin.projects.index', compact('projects', 'types'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $project = new Project;
        $types = Type::select('label', 'id')->get();
        $technologies = Technology::select('label', 'id')->get();
        return view('admin.projects.create', compact('project', 'types', 'technologies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request)
    {


        $data = $request->validated();

        $new_project = new Project();

        $new_project->fill($data);

        $new_project->slug = Str::slug($new_project->title);

        if (Arr::exists($data, 'image')) {

            if ($new_project->image) Storage::delete($new_project->image);

            $extension = $data['image']->extension();

            $img_url = Storage::putFileAs('projects_images', $data['image'], "$new_project->slug.$extension");
            $new_project->image = $img_url;
        }


        $new_project->save();

        if (Arr::exists($data, 'technologies')) {
            $new_project->technologies()->attach($data['technologies']);
        }

        return redirect()->route('admin.projects.show', $new_project->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        $types = Type::select('label', 'id')->get();
        return view('admin.projects.show', compact('project', 'types'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        $old_techs = $project->technologies->pluck('id')->toarray();

        $types = Type::select('label', 'id')->get();
        $technologies = Technology::select('label', 'id')->get();

        return view('admin.projects.edit', compact('project', 'types', 'technologies', 'old_techs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        $data = $request->validated();

        if (Arr::exists($data, 'image')) {

            if ($project->image) Storage::delete($project->image);

            $extension = $data['image']->extension();

            $img_url = Storage::putFileAs('projects_images', $data['image'], "$project->slug.$extension");
            $project->image = $img_url;
        }

        if (Arr::exists($data, 'technologies')) {
            $project->technologies()->sync($data['technologies']);
        } elseif (!Arr::exists($data, 'technologies') && $project->has('technologies')) {
            $project->technologies()->detach();
        }

        $project->slug = $data['slug'];

        $project->update($data);

        return redirect()->route('admin.projects.show', $project)
            ->with('type', 'success')
            ->with('message', "$project->title modificato con successo.");
    }

    /**
     * Remove the specified resource from storage.
     */
    // public function destroy(Project $project)
    // {
    //     $project->delete();

    //     return redirect()->route('admin.projects.index')
    //         ->with('type', 'success')
    //         ->with('message', "$project->title eliminato con successo.");
    // }

    public function trash()
    {
        $projects = Project::onlyTrashed()->get();

        return view('admin.projects.trash', compact('projects'));
    }

    public function restore(Project $project)
    {
        $project->restore();

        return to_route('admin.projects.index')
            ->with('type', 'success')
            ->with('message', 'Post ripristinato con successo');
    }

    public function drop(Project $project)
    {
        if ($project->image) Storage::delete($project->image);

        if ($project->has('technologies')) $project->tags()->detach();

        return redirect()->route('admin.projects.trash')
            ->with('type', 'warning')
            ->with('message', "$project->title eliminato definitivamente.");
    }
}
