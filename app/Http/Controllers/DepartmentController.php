<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\User;
use App\Models\Role;
use Flasher\Laravel\Facade\Flasher;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */



    public function __construct()
    {
        $this->middleware(['permission:departments-read'])->only(['index' ,'show']);
        $this->middleware(['permission:departments-create'])->only('create');
        $this->middleware(['permission:departments-update'])->only('edit');
        $this->middleware(['permission:departments-delete'])->only('destroy');
    }
    public function index(Request $request)
    {


        $departments = Department::when($request->search, function ($q) use ($request) {
            return $q->where('name' , 'like', '%' . $request->search . '%');
        })->latest()->paginate(15);
        return view('departments.index' , compact('departments'  ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('departments.create');
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
            'name'=>['required', 'string', 'max:255' , 'unique:'.Department::class],
            'description'=>'required|min:3|max:1000',
        ]);

        Department::create($request->all());
        Flasher::addSuccess('Department created successfully.');
        return redirect()->route('departments.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function show(Department $department)
    {
        $manager = $department->users()->whereRoleIs('manager' );
        $admin = $department->users()->whereRoleIs('admin' );


        return view('departments.show' , compact('department' , 'manager' , 'admin'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function edit(Department $department)
    {
        return view('departments.edit' , compact('department'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Department $department)
    {

        $request->validate([
            'name'=>['required', 'string', 'max:255' , Rule::unique('users')->ignore($department->id)],
            'description'=>'required|min:3|max:1000',
        ]);

        $department->update($request->all());
        Flasher::addSuccess('Department updated successfully.');
        return redirect()->route('departments.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function destroy(Department $department)
    {
        if($department->id ==1){
            Flasher::addError('This Department can\'t be deleted.');
            return redirect()->route('departments.index');

        }

            foreach ($department->users as $user ){
                $user->update([
                   'department_id' =>1
                ]);
            }
            $department->delete();
        Flasher::addSuccess('Department deleted successfully.');
        return redirect()->route('departments.index');

    }
}
