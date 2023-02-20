@extends('includes.dashboard')

@section('title')

    Tasks
@endsection


@section('styles')

@endsection

@section('content')
    <div class="right_col" role="main">


        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>tasks <small></small></h3>
                </div>


            </div>
            <div class="clearfix"></div>
            <div class="row" style="display: block;">


                <div class="x_panel">
                    <div class="x_title">
                        <h2>tasks count<small>{{$tasks->total()}}</small></h2><br>


                        <div class="clearfix"></div>
                    </div>
                    @if(auth()->user()->hasPermission('tasks-create'))

                        <a href="{{route('tasks.create')}}" class="btn btn-round btn-success">Create task</a>
                    @endif


                    <form action="{{route('tasks.index')}}" method="get">

                        <div class="">
                            <div class="col-md-5 col-sm-5   form-group  top_search">
                                <div class="input-group ">

                                    @if(auth()->user()->hasRole('admin|super_admin'))
                                        <div class="col-md-5 col-sm-5">
                                            <select class="custom-select" name="department">
{{--                                                <option selected disabled> Select Department</option>--}}
                                                <option value="" selected> All Department</option>

                                                @foreach($departments as $department)

                                                    <option
                                                        value="{{$department->id}}" {{Request()->department ==$department->id ? 'selected' :   ''}}>{{$department->name}}</option>

                                                @endforeach


                                            </select>
                                        </div>
                                    @endif
                                            <select class="custom-select" name="status">
                                                <option selected value="">All Status</option>


                                                    <option value="In progress" {{Request()->status =='In progress' ? 'selected' :   ''}}>In progress</option>
                                                        <option value="Completed" {{Request()->status =='Completed' ? 'selected' :   ''}}>Completed</option>



                                            </select>

                                    <input type="text" class="form-control" name="search"
                                           placeholder="Search for task..." value="{{Request()->search}}">
                                    <span class="input-group-btn">
                                    <button class="btn btn-success" type="submit"><div style="color: white">Go!</div></button>
                                        </span>




                                </div>

                            </div>
                        </div>

                    </form>


                    <div class="x_content">
                        @if($tasks->count() >0)

                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>title</th>
                                    <th>body</th>
                                    <th>status</th>
                                    <th>Created by</th>
                                    <th>Department</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($tasks as $index=>$task)
                                    <tr>
                                        <th scope="row">{{$index+1}}</th>
                                        <td>{!! Str::limit($task->title, 15) !!}</td>

                                        <td style="padding-left:5px;" > <div style="height: 50px; width: 200px; overflow:hidden;"> {!! Str::limit($task->body, 40) !!} </div></td>

                                        <td><span
                                                class="badge mt-2 {{$task->status == 'Completed' ?'badge-success' : 'badge-warning'}} "> <b>{{$task->status}}</b></span>
                                        </td>


                                        <td>{{$task->user->name}}</td>
                                        <td>{{$task->department->name}}</td>
                                        <td>{{$task->created_at->format('d M Y')}} <small
                                                class="text-success">({{now()->diffInDays($task->created_at)}}D)</small>
                                        </td>


                                        <td>
                                            @if(auth()->user()->hasPermission('tasks-read'))

                                                <a class="btn btn-primary btn-sm btn-round"
                                                   href="{{route('tasks.show' , $task->id)}}">
                                                    <i class="fa fa-book"></i> View</a>

                                            @endif
                                            @if(auth()->user()->hasPermission('tasks-update'))

                                                <a class="btn btn-warning btn-sm btn-round"
                                                   href="{{route('tasks.edit' , $task->id)}}">
                                                    <i class="fa fa-edit"></i> Edit</a>

                                            @endif
                                            @if(auth()->user()->hasPermission('tasks-delete'))

                                                <button class="btn btn-danger btn-sm btn-round" data-toggle="modal"
                                                        data-target="#delete{{$task->id}}">
                                                    <i class="fa fa-trash"></i> Delete
                                                </button>


                                                <form action="{{ route('tasks.destroy', $task->id) }}" method="post">
                                                    {{ csrf_field() }}
                                                    {{ method_field('delete') }}


                                                    <div class="modal fade" id="delete{{$task->id}}">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title"><i
                                                                            class="fa fa-warning"></i>
                                                                        Confirm Delete</h4>
                                                                    <button type="button" class="close"
                                                                            data-dismiss="modal"
                                                                            aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <p>Are you sure you want to delete this task
                                                                        <b>"{{$task->title}}"</b></p>
                                                                </div>
                                                                <div class="modal-footer justify-content-between">

                                                                    <button type="button" class="btn btn-success"
                                                                            data-dismiss="modal">Close
                                                                    </button>


                                                                    <button type="submit" class="btn delete btn-danger">
                                                                        Confirm
                                                                    </button>

                                                                </div>
                                                            </div>
                                                            <!-- /.modal-content -->
                                                        </div>
                                                        <!-- /.modal-dialog -->
                                                    </div>
                                                </form>

                                            @endif


                                        </td>


                                    </tr>

                                @endforeach

                                </tbody>
                            </table>
                            {!! $tasks->appends(request()->query())->links() !!}

                        @else
                            <br>
                            <h3 class="text-center border border-secondary p-3"> No data found</h3>
                        @endif

                    </div>
                </div>


            </div>
        </div>
    </div>

@endsection


@section('scripts')


@endsection
