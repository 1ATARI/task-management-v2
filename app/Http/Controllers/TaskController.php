<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Task;
use Flasher\Laravel\Facade\Flasher;
use http\Client\Curl\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function __construct()
    {
        $this->middleware(['permission:tasks-read'])->only(['index' ,'show']);
        $this->middleware(['permission:tasks-create'])->only('create');
        $this->middleware(['permission:tasks-update'])->only('edit');
        $this->middleware(['permission:tasks-delete'])->only('destroy');
    }
    public function index(Request $request)
    {

        if (auth()->user()->hasRole(['super_admin|admin'])){
            $tasks = Task::when($request->search, function ($q) use ($request) {
                return $q->where('title' , 'like', '%' . $request->search . '%');
            })->when($request->department, function ($q) use ($request) {

                return $q->where('department_id', $request->department);

            })->when($request->status, function ($q) use ($request) {

                return $q->where('status' , $request->status);

            })->latest()->paginate(15);

        }else{

            $tasks = Task::where([['department_id' , auth()->user()->department_id],

                ])->when($request->search, function ($q) use ($request) {
                return $q->where(
                    'title' , 'like', '%' . $request->search . '%');
            })->when($request->status, function ($q) use ($request) {

                return $q->where('status' , $request->status);

            })->latest()->paginate(15);



        }
        $departments = Department::all();
        return view('tasks.index' , compact('tasks' , 'departments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (auth()->user()->hasRole('admin|super_admin')){
        $departments = Department::all();
        }else{
        $departments = Department::where('id' , auth()->user()->department_id)->get();
        }
        return view('tasks.create' , compact('departments'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'title'=>['required', 'string', 'max:255' ],
            'body'=>'required|min:3|max:1000',
            'status'=>['required' , Rule::in(['In progress', 'Completed'])],
            'department_id'=>'required'

        ]);

        $request['user_id'] =auth()->user()->id;
        Task::create($request->all());
        $user = auth()->user();
        $user->update([
            'task_count'=>$user->task_count+1,

        ]);

        Flasher::addSuccess('Task created successfully.');
        return redirect()->route('tasks.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        return view('tasks.show' , compact('task'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        $departments = Department::all()->except(['id' , 1]);

        return view('tasks.edit' , compact('task' , 'departments'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        $request->validate([
            'title'=>['required', 'string', 'max:255' ],
            'body'=>'required|min:3|max:1000',
            'status'=>['required' , Rule::in(['In progress', 'Completed'])],
            'department_id'=>'required'

        ]);


        $task->update($request->all());

        Flasher::addSuccess('Task updated successfully.');
        return redirect()->route('tasks.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $user =$task->user;
        if ($user->task_count >0){


        $user->update([
            'task_count'=>$user->task_count-1,

        ]);
        }
        $task->delete();
        Flasher::addSuccess('Task deleted successfully.');
        return redirect()->route('tasks.index');




    }
}
