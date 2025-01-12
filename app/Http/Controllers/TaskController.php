<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $tasks = Task::query();

        $tasks->when($request->keyword, function ($query, $keyword) {
            $query->where(function ($q) use ($keyword) {
                $q->where('name', 'like', '%' . $keyword . '%');
            });
        });

        $tasks = $tasks->paginate(6);

        $totalProjects = Project::count();
        $totalEmployees = User::count();
        $totalTask = Task::count();

        return view('tasks.index', [
            'tasks' => $tasks,
            'totalProjects' => $totalProjects,
            'totalEmployees' => $totalEmployees,
            "totalTask" => $totalTask
        ]);
    }

    public function show(Task $task)
    {
        // Carregar os usuários relacionados com a task
        $task->load('users');

        return view('tasks.show', compact('task'));
    }

    public function create()
    {
        $projects = Project::all();
        $departments = Department::with('users')->get();
        return view('tasks.create', [
            'projects' => $projects,
            'departments' => $departments
        ]);
    }

    // TaskController.php

    public function store(Request $request)
    {
        // Validação dos dados
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'deadline' => 'required|date',
            'project_id' => 'required|exists:projects,id',
            'users' => 'required|array', // Assumindo que é um array de ids
            'users.*' => 'exists:users,id', // Verifica se cada id de usuário existe
        ]);

        // Criação da task
        $task = new Task();
        $task->name = $validated['name'];
        $task->description = $validated['description'];
        $task->deadline = $validated['deadline'];
        $task->project_id = $validated['project_id'];
        $task->creator = auth()->user()->name;
        $task->status = 'Pending';
        $task->save();

        // Attach users to the task (muitos para muitos)
        $task->users()->attach($validated['users']);

        // Redirecionar com sucesso
        return redirect()->route('tasks.index')->with('status', 'Task created successfully!');
    }


}
