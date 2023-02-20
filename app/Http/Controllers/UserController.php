<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Role;
use App\Models\Task;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Flasher\Laravel\Facade\Flasher;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;


class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware(['permission:users-read'])->only(['index' ,'show']);
        $this->middleware(['permission:users-create'])->only('create');
        $this->middleware(['permission:users-update'])->only('edit');
        $this->middleware(['permission:users-delete'])->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (auth()->user()->hasRole(['super_admin|admin'])){
            $users = User::where([
                ['name','like','%'.$request->search."%"],
            ])
                ->latest()->paginate(15);

        }else{
            $users =User::where([['department_id' , auth()->user()->department_id],
                ['name','like','%'.$request->search."%"]
                ])->whereRoleIs(['manager', 'user'])->latest()->paginate(15);
        }

        $department = Department::all();
        return view('users.index' , compact('users' , 'department'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $deps = Department::all();
        if (auth()->user()->hasRole('super_admin')){
            $roles = Role::all();

        }elseif(auth()->user()->hasRole('admin'))
        {
            $roles = Role::all()->except([1 ,2]);
        }elseif(auth()->user()->hasRole('manager'))
        {
            $roles = Role::all()->except([1 ,2,3]);

        }
        return view('users.create' ,compact('deps' , 'roles'));
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role'=>'required',
            'department_id'=>'required',
            'image'=>'image',
        ]);

        $request_data = $request->except(['password' , 'role' , 'image']);

        if ($request->image) {
            $request_data['image'] = $request->file('image')->store('users_image', 'public_uploads');

        }
        $request_data['password'] = bcrypt($request->password);

        $user = User::create($request_data);
        $user->attachRole($request->role);

        Flasher::addSuccess('User created successfully.');

        return redirect()->route('users.index');


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        $Dtasks = Task::where('user_id' , $user->id)->whereDate('created_at', Carbon::today())->get();



        return view('users.show' , compact('user' , 'Dtasks' ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        if (!auth()->user()->hasRole('super_admin') && $user->hasRole('super_admin')){
            Flasher::addError('You Don\'t have permission to edit this user');

        return abort(403);
        }

        if (auth()->user()->hasRole('admin') && $user->hasRole('admin') &&$user->id !=auth()->user()->id){
            Flasher::addError('You Don\'t have permission to edit this user');

        return abort(403);
        }




        $departments = Department::all();
        $role = $user->roles()->first();
        if (auth()->user()->hasRole('super_admin')){
            $roles = Role::all();

        }elseif(auth()->user()->hasRole('admin'))
        {
            $roles = Role::all()->except([1 ,2]);
        }elseif(auth()->user()->hasRole('manager'))
        {
            $roles = Role::all()->except([1 ,2,3]);

        }

        return view('users.edit' , compact('user' , 'departments' , 'role' , 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($id)],
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
            'role'=>'required',
            'department_id'=>'required',
            'image'=>'image',

        ]);

        $request_data = $request->except(['password' , 'role' , 'image']);

        if ($request->image) {
            if($user->image != 'users_image/user.png'){

                Storage::disk('public_uploads')->delete($user->image);


            }
            $request_data['image'] = $request->file('image')->store('users_image', 'public_uploads');

        }
        $request_data['password'] = bcrypt($request->password);




        $user->update($request_data);

        if ($request->role){
            $user->detachRole($user->role);
            $user->attachRole($request->role);

        }

        Flasher::addSuccess('User updated successfully.');

        return redirect()->route('users.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        if (auth()->user()->hasRole('admin') && $user->hasRole('super_admin')){
            Flasher::addError('You Don\'t have permission to delete this user');

            return abort(403);

        }

        if (auth()->user()->hasRole('admin') && $user->hasRole('admin')){

            Flasher::addError('You Don\'t have permission to delete this user');

            return abort(403);
        }


        if($user->image != 'users_image/user.png'){

            Storage::disk('public_uploads')->delete( $user->image);
        }
        $user->delete();
        Flasher::addSuccess('User deleted successfully.');

        return redirect()->route('users.index');
    }
}
