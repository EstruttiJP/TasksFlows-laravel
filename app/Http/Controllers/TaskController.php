<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\TaskUpdate;
use App\Models\Department;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Mail\NewTask;
use Illuminate\Support\Facades\Mail;

class TaskController extends Controller
{
    protected $commentController;

    public function __construct(CommentController $commentController)
    {
        $this->commentController = $commentController;
    }
    public function index(Request $request)
    {
        $tasks = Task::query();

        $tasks->when($request->keyword, function ($query, $keyword) {
            $query->where(function ($q) use ($keyword) {
                $q->where('name', 'like', '%' . $keyword . '%');
            });
        });

        // ordenação por status
        $tasks = $tasks->orderByRaw("FIELD(status, 'Pending', 'In progress', 'Completed')");

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
        $task->load('project', 'users');
        $comments = $this->commentController->index($task->id)->getData();
        $created_at = Carbon::parse($task->created_at)->format('d/m/Y \à\s H:i');
        $deadline = Carbon::parse($task->deadline)->format('d/m/Y');
        return view('tasks.show', compact('task', 'comments', 'created_at', 'deadline'));
    }

    public function create()
    {
        Gate::authorize('edit', User::class);
        $projects = Project::all();
        $departments = Department::with('users')->get();
        return view('tasks.create', [
            'projects' => $projects,
            'departments' => $departments
        ]);
    }

    public function store(Request $request)
    {
        Gate::authorize('edit', User::class);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'deadline' => 'required|date',
            'project_id' => 'required|exists:projects,id',
            'users' => 'required|array',
            'users.*' => 'exists:users,id',
        ]);

        $task = new Task();
        $task->name = $validated['name'];
        $task->description = $validated['description'];
        $task->deadline = $validated['deadline'];
        $task->project_id = $validated['project_id'];
        $task->creator = auth()->user()->name;
        $task->status = 'Pending';
        $task->save();

        $taskDetails = [
            'task_name' => $task->name,
            'task_description' => $task->description,
            'task_launch_date' => $task->created_at->format('Y-m-d'),
            'task_deadline' => $task->deadline,
            'project_name' => $task->project->name,
            'task_status' => $task->status
        ];

        foreach ($validated['users'] as $userId) {
            $user = User::find($userId);
            if ($user) {
                Mail::to($user->email)->send(new NewTask($taskDetails));
            }
        }

        return redirect()->route('tasks.index')->with('status', 'Task created and emails sent successfully!');
    }



    public function edit(Task $task)
    {
        Gate::authorize('edit', User::class);
        $projects = Project::all();
        $departments = Department::with('users')->get();
        return view('tasks.edit', [
            'task' => $task,
            'projects' => $projects,
            'departments' => $departments
        ]);
    }
    public function update(Request $request, Task $task)
    {
        // Validate data
        $input = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'deadline' => 'required|date',
            'project_id' => 'required|exists:projects,id',
            'status' => 'required|string',
            'users' => 'required|array',
            'users.*' => 'exists:users,id',
        ]);

        $task->name = $input['name'];
        $task->description = $input['description'];
        $task->deadline = $input['deadline'];
        $task->project_id = $input['project_id'];
        $task->status = $input['status'];
        $task->save();

        // Attach users to the task (many-to-many)
        $task->users()->sync($input['users']);

        // Prepare task details for the update email
        $taskDetails = [
            'task_id' => $task->id,
            'task_name' => $task->name,
            'task_description' => $task->description,
            'task_launch_date' => $task->created_at->format('Y-m-d'),
            'task_deadline' => $task->deadline,
            'project_name' => $task->project->name,
            'task_status' => $task->status
        ];

        // Send email to each user assigned to the task
        foreach ($input['users'] as $userId) {
            $user = User::find($userId);
            if ($user) {
                Mail::to($user->email)->send(new TaskUpdate($taskDetails));
            }
        }

        // Redirect with success message
        return redirect()->route('tasks.index')->with('status', 'Task updated and emails sent successfully!');
    }

    public function destroy(Task $task)
    {
        Gate::authorize('destroy', User::class);
        $task->delete();
        return back()
            ->with('status', 'Employee successfully deleted');
    }
}
