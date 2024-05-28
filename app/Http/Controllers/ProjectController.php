<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Organization;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Organization $organization)
    {
        return response($organization->projects);
    }

    /**
     * Show the form for creating a new resource.
     */
    // public function create(Request $request, Organization $organization)
    // {
    //     //
    // }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Organization $organization)
    {
        $project = new Project();
        $project->fill($request->input());
        $project->organization()->associate($organization);
        $project->save();

        return response($project);
    }

    /**
     * Display the specified resource.
     */
    public function show(Organization $organization, Project $project)
    {
        return response($project);
    }

    /**
     * Show the form for editing the specified resource.
     */
    // public function edit(Project $project)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Organization $organization, Project $project)
    {
        $project->fill($request->input());
        $project->save();

        return response($project);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Organization $organization, Project $project)
    {
        if($project->delete())
        {
            return response(['message' => "$project->name has been deleted."]);
        }
        {
            return response(['message' => "failed to delete $project->name."]);
        }
    }
}
