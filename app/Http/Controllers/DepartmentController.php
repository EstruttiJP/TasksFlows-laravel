<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class DepartmentController extends Controller
{
    public function index(Request $request)
    {
        $departments = Department::query();

        $departments->when($request->keyword, function ($query, $keyword) {
            $query->where(function ($q) use ($keyword) {
                $q->where('name', 'like', '%' . $keyword . '%');
            });
        });

        $departments = $departments->paginate(10);

        $totalDepartment = Department::count();
        $totalEmployees = User::count();
        $totalProjects = Project::count();

        return view('departments.index', [
            'departments' => $departments,
            'totalDepartment' => $totalDepartment,
            'totalEmployees' => $totalEmployees,
            "totalProjects" => $totalProjects
        ]);
    }

    public function create()
    {
        Gate::authorize('edit', User::class);
        return view('departments.create');
    }

    public function store(Request $request)
    {
        Gate::authorize('edit', User::class);
        // Validação dos dados do formulário
        $input = $request->validate([
            'name' => 'required'
        ]);

        Department::create($input);

        return back()->with('status', 'Department created successfully');
    }

    public function edit(Department $department)
    {
        Gate::authorize('edit', User::class);
        return view('departments.edit', [
            'department' => $department
        ]);
    }

    public function update(Request $request, Department $department)
    {
        Gate::authorize('edit', User::class);
        // Validação dos dados do formulário
        $input = $request->validate([
            'name' => 'required'
        ]);

        $department->fill($input);
        $department->save();

        return back()->with('status', 'Department updated successfully');
    }

    public function destroy(Department $department)
    {
        Gate::authorize('destroy', User::class);
        $department->delete();
        return back()
            ->with('status', 'Department successfully deleted');
    }
}
