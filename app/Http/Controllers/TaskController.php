<?php

namespace App\Http\Controllers;

use App\Models\Feature;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Feature $feature)
    {
        return response($feature->tasks);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request, Feature $feature)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Feature $feature)
    {
        $task = new Task();
        $task->fill($request->input());

        $this->__setAssignee($request, $task);
        $this->__setAssigner($request, $task);

        $task->feature()->associate($feature);
        $task->save();

        return response($task);
    }

    /**
     * Display the specified resource.
     */
    public function show(Feature $feature, Task $task)
    {
        return response($task);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $feature, Task $task)
    {
        $task->fill($request->input());
        if ($request->input('feature_id') != $feature) {
            $newFeature = Feature::findOrFail($request->input('feature_id'));
            $task->feature()->associate($newFeature);
        }
        $task->save();

        return response($task);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $feature, Task $task)
    {
        if ($task->delete())
        {
            return response([
                "message" => "Task $task->name berhasil dihapus",
                "status" => 200
            ]);
        }
        else
        {
            return response([
                "message" => "Task $task->name gagal dihapus",
                "status" => 500
            ], 500);
        }
    }

    private function __setAssignee(Request $request, Task &$task)
    {
        if ($request->assignee_id) {
            $assignee = Person::find($request->assignee_id);
            if ($assignee) {
                $task->assignee()->associate($assignee);
            }
        }
    }

    private function __setAssigner(Request $request, Task &$task)
    {
        if ($request->assigner_id) {
            $assignee = Person::find($request->assigner_id);
            if ($assigner) {
                $task->assignee()->associate($assigner);
            }
        }
    }
}
