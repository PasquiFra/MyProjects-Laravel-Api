<?php

namespace App\Http\Controllers\Guest;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Type;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::whereIsPublished('1')->get();
        $types = Type::select('label', 'id')->get();
        return view('guest.projects.index', compact('projects', 'types'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        $types = Type::select('label', 'id')->get();
        return view('guest.projects.show', compact('project', 'types'));
    }
}
