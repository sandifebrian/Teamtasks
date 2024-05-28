<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Task;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Task $task)
    {
        return response($task->comments);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Task $task)
    {
        $comment = new Comment();
        $comment->fill($request->input());

        $comment->creator_id = 1;

        $comment->task()->associate($task);
        $comment->save();

        return response($comment);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $task, Comment $comment)
    {
        return response($comment);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $task,Comment $comment)
    {
        if ($comment->delete())
        {
            return response([
                "message" => "Komentar berhasil dihapus",
                "status" => 200
            ]);
        }
        else
        {
            return response([
                "message" => "Komentar gagal dihapus",
                "status" => 500
            ], 500);
        }
    }
}
