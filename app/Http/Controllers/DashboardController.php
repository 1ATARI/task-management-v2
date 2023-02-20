<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Task;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {

        $tasks = Task::all();
        $users = User::all();
        $departments = Department::all();
        $Dtasks = Task::whereDate('created_at', Carbon::today())->get();



        return view('dashboard' , compact('departments' , 'users' , 'tasks' , 'Dtasks' ));
    }
}
