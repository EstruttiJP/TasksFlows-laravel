<?php

namespace App\Http\Controllers;
use App\Models\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        $users = User::paginate(10);
        $totalEmployee = User::count();
        return view('employees.index', [
            'users'=>$users,
            'totalEmployee' => $totalEmployee
        ]);
    }
    public function edit(User $user){
        return view('employees.edit', [
            'user'=>$user
        ]);
    }

    public function update(User $user, Request $request){
        $input = $request->validate([
            'name'=>'required',
            'email'=>'required|email',
            'password'=>'exclude_if:password,null|min:6'
        ]);
        $user->fill($input);
        $user->save();
        return back()
        ->with('status', 'Employee updated successfully');
    }

    public function destroy(User $user){
        $user->delete();
        return back()
        ->with('status', 'Employee successfully deleted');
    }
}
