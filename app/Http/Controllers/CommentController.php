<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    // Função para listar todos os comentários de uma tarefa
    public function index($taskId)
    {
        $comments = Comment::where('task_id', $taskId)->with('user')->get();
        return response()->json($comments);
    }

    // Função para cadastrar um novo comentário
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'task_id' => 'required|exists:tasks,id',
            'comment' => 'required|string',
        ]);

        $comment = Comment::create($request->all());
        return back()->with('status', 'Comment add successfully');
    }
}

