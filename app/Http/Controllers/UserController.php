<?php

namespace App\Http\Controllers;
use App\Models\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        $users = User::paginate(10);
        $totalUsers = User::count();
        return view('home', [
            'users'=>$users,
            'totalUsers' => $totalUsers
        ]);
    }
}
