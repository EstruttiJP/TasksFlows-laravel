<?php

namespace App\Http\Controllers;
use App\Models\Department;
use App\Models\Project;
use App\Models\Role;
use App\Models\Task;
use App\Models\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::query();

        $users->when($request->keyword, function ($query, $keyword) {
            $query->where(function ($q) use ($keyword) {
                $q->where('name', 'like', '%' . $keyword . '%')
                    ->orWhere('email', 'like', '%' . $keyword . '%');
            });
        });

        $users = $users->with('department')->paginate(10);

        $totalEmployee = User::count();
        $totalProject = Project::count();
        $totalTask = Task::count();

        return view('employees.index', [
            'users' => $users,
            'totalEmployee' => $totalEmployee,
            'totalProject' => $totalProject,
            "totalTask" => $totalTask
        ]);
    }
    public function edit(User $user)
    {
        Gate::authorize('edit', User::class);
        $roles = Role::all();
        $departments = Department::all();
        return view('employees.edit', [
            'user' => $user,
            'roles' => $roles,
            'departments' => $departments
        ]);
    }

    public function update(Request $request, User $user)
    {
        Gate::authorize('edit', User::class);
        // Validação dos dados do formulário
        $input = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'exclude_if:password,null|min:6',
            'department_id' => 'required|exists:departments,id',
            'role_id' => 'required|exists:roles,id',
        ]);

        // Sincronizar o relacionamento muitos-para-muitos para as roles
        $user->roles()->sync([$input['role_id']]);

        // Atualizar o department_id diretamente no modelo User
        $user->department_id = $input['department_id'];

        // Remover role_id do array $input para evitar problemas com fill
        unset($input['role_id']);

        // Preencher e salvar o usuário
        $user->fill($input);
        $user->save();

        return back()->with('status', 'Employee updated successfully');
    }

    public function destroy(User $user)
    {
        Gate::authorize('destroy', User::class);
        $user->delete();
        return back()
            ->with('status', 'Employee successfully deleted');
    }
}
