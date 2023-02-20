@extends('includes.dashboard')

@section('title')

    Departments
@endsection


@section('styles')
    <style>
        .vcenter {
            display: inline-block;
            vertical-align: middle;
            float: none;
        }

    </style>
@endsection

@section('content')
    <div class="right_col" role="main">

        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Departments <small></small></h3>
                </div>
                <form action="{{route('departments.index')}}" method="get">

                    <div class="title_right">
                        <div class="col-md-5 col-sm-5   form-group pull-right top_search">
                            <div class="input-group">
                                <input type="text" class="form-control" name="search"
                                       placeholder="Search for department...">
                                <span class="input-group-btn">
                      <button class="btn btn-default" type="submit">Go!</button>
                    </span>

                            </div>
                        </div>
                    </div>
                </form>

            </div>
            <div class="clearfix"></div>
            <div class="row" style="display: block;">


                <div class="x_panel">
                    <div class="x_title">
                        <h2>Departments<small> count {{$departments->total()}}</small></h2><br>


                        <div class="clearfix"></div>
                    </div>
                    @if(auth()->user()->hasPermission('departments-create'))

                        <a href="{{route('departments.create')}}" class="btn btn-round btn-success">Create
                            department</a>
                    @endif


                    <div class="x_content">
                        @if($departments->count() >0)
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th style="width: 1%">#</th>
                                <th>Name</th>
                                <th class="text-center">Number of Employees</th>
                                <th style="width: 20%" class="text-center">Managers/Admins</th>
                                <th>Department tasks</th>

                                @if(!auth()->user()->hasRole('user'))
                                    <th>Action</th>
                                @endif
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($departments as $index=>$department)

                                <tr>
                                    <th scope="row">{{$index+1}}</th>
                                    <td>{{$department->name}}</td>
                                    <td class="text-center">{{$department->users->count()}}</td>
                                    <td>
                                        @php
                                            $num=0
                                        @endphp
                                        @foreach($department->users as $users)

                                            @if($users->hasRole('manager|admin'))
                                                @php
                                                    $num++
                                                @endphp

                                                <ul class="list-inline mb-0">
                                                    <li class="vcenter"><img src="{{$users->image_path}}"
                                                                             class="avatar " alt="Avatar"></li>
                                                    <p class="d-inline vcenter ">
                                                        {{ Str::limit($users->name, 15) }}</p>
                                                    @foreach($users->roles as $role)
                                                        ({{$role->display_name}})
                                                    @endforeach
                                                    @if($num > 1)
                                                        <br>
                                                        <a href="{{route('departments.show' , $department->id)}}"
                                                           class="text-success"><b>see more ...</b></a>
                                                        @break
                                                    @endif

                                                </ul>

                                            @endif

                                        @endforeach

                                        @if($num == 0)
                                            <p class="text-danger"><b>No mangers or admins exist</b></p>
                                        @endif

                                    </td>
                                    <td>
                                        {{$department->tasks->count()}}

                                    </td>


                                    <td>
                                        @if(auth()->user()->hasPermission('departments-read'))

                                            <a class="btn btn-primary btn-sm btn-round"
                                               href="{{route('departments.show' , $department->id)}}">
                                                <i class="fa fa-book"></i> View</a>

                                        @endif
                                        @if(auth()->user()->hasPermission('departments-update'))

                                            <a class="btn btn-warning btn-sm btn-round"
                                               href="{{route('departments.edit' , $department->id)}}">
                                                <i class="fa fa-edit"></i> Edit</a>

                                        @endif
                                        @if(auth()->user()->hasPermission('departments-delete'))

                                            <button class="btn btn-danger btn-sm btn-round" data-toggle="modal"
                                                    data-target="#delete{{$department->id}}">
                                                <i class="fa fa-trash"></i> Delete
                                            </button>


                                            <form action="{{ route('departments.destroy', $department->id) }}"
                                                  method="post">
                                                {{ csrf_field() }}
                                                {{ method_field('delete') }}


                                                <div class="modal fade" id="delete{{$department->id}}">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title"><i class="fa fa-warning"></i>
                                                                    Confirm Delete</h4>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                        aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p>Are you sure you want to delete this department
                                                                    <b>"{{$department->name}}"</b></p>
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
                        {!! $departments->links() !!}

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
