<?php

namespace App\Http\Controllers;

use App\Models\Feature;
use App\Models\Project;
use Illuminate\Http\Request;

class FeatureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Project $project)
    {
        return response($project->features);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request, $project)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Project $project)
    {
        $feature = new Feature();
        $feature->fill($request->input());
        $feature->project()->associate($project);
        $feature->save();

        return response($feature);
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project, Feature $feature)
    {
        return response($feature);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Feature $feature)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Feature $feature)
    {
        $feature->fill($request->input());
        if ($feature->project->id != $request->project_id) {
            $feature->project()->associate($project);
        }
        $feature->save();

        return response($feature);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project, Feature $feature)
    {
        if ($feature->delete())
        {
            return response([
                "message" => "Fitur $feature->name berhasil dihapus",
                "status" => 200
            ]);
        }
        else
        {
            return response([
                "message" => "Fitur $feature->name gagal dihapus",
                "status" => 500
            ], 500);
        }
    }
}
