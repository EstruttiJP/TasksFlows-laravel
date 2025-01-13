<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $projects = Project::query();

        $projects->when($request->keyword, function ($query, $keyword) {
            $query->where(function ($q) use ($keyword) {
                $q->where('name', 'like', '%' . $keyword . '%');
            });
        });

        $projects->when($request->department, function ($query, $department) {
            $query->whereHas('department', function ($q) use ($department) {
                $q->where('name', 'like', '%' . $department . '%');
            });
        });

        $projects = $projects->paginate(6);

        $totalProjects = Project::count();
        $totalEmployees = User::count();
        $totalTask = Task::count();

        return view('projects.index', [
            'projects' => $projects,
            'totalProjects' => $totalProjects,
            'totalEmployees' => $totalEmployees,
            "totalTask" => $totalTask
        ]);
    }

    public function create()
    {
        Gate::authorize('edit', User::class);
        $departments = Department::all();
        return view('projects.create', [
            'departments' => $departments
        ]);
    }

    public function store(Request $request)
    {
        Gate::authorize('edit', User::class);

        // Validação dos dados do formulário
        $input = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'creator' => 'required|string|max:255',
            'deadline' => 'required|date',
            'department_id' => 'required|exists:departments,id',
        ]);

        Project::create($input);

        return redirect()->route('projects.create')->with('status', 'Project created successfully');
    }


    public function edit(Project $project)
    {
        Gate::authorize('edit', User::class);
        $departments = Department::all();
        return view('projects.edit', [
            'project' => $project,
            'departments' => $departments
        ]);
    }

    public function update(Request $request, Project $project)
    {
        Gate::authorize('edit', User::class);
        // Validação dos dados do formulário
        $input = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'deadline' => 'required|date',
            'department_id' => 'required|exists:departments,id',
        ]);
        $project->department_id = $input['department_id'];
        $project->fill($input);
        $project->save();

        return back()->with('status', 'Project updated successfully');
    }

    public function destroy(Project $project)
    {
        Gate::authorize('destroy', User::class);
        $project->delete();
        return back()
            ->with('status', 'Project successfully deleted');
    }
    
}
