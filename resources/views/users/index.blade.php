@extends('includes.dashboard')

@section('title')

    Users
@endsection


@section('styles')

@endsection

@section('content')
    <div class="right_col" role="main">


    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Users <small></small></h3>
            </div>
            <form action="{{route('users.index')}}" method="get">

            <div class="title_right">
                <div class="col-md-5 col-sm-5   form-group pull-right top_search">
                    <div class="input-group">
                        <input type="text" class="form-control" name="search" placeholder="Search for user...">
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
                    <h2>Users count<small>{{$users->total()}}</small></h2><br>


                    <div class="clearfix"></div>
                </div>
                @if(auth()->user()->hasPermission('users-create'))

                    <a href="{{route('users.create')}}" class="btn btn-round btn-success">Create User</a>
                @endif



                <div class="x_content">
                    @if($users->count() >0)

                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Image</th>
                            <th>Department</th>
                            <th class="text-center">Task count</th>

                            @if(!auth()->user()->hasRole('user'))
                                <th>Role</th>
                            @endif
                            @if(!auth()->user()->hasRole('user'))

                                <th>Activity</th>
                            @endif
                            @if(!auth()->user()->hasRole('user'))
                                <th class="text-center ">Action</th>
                            @endif

                        </tr>
                        </thead>
                        <tbody>

                        @foreach($users as $index=>$user)
                            <tr>
                                <th scope="row">{{$index+1}}</th>
                                <td>{{$user->name}}</td>
                                <td class="user-profile"><img src="{{$user->image_path}}"
                                                              style="width: 50px; height: 50px" class="img-thumbnail">
                                </td>
                                <td>{{$user->department->name}}</td>
                                <td class="text-center">{{$user->task_count}}</td>
                                @if(!auth()->user()->hasRole('user'))
                                    @foreach($user->roles as $role)
                                        <td>
                                            {{$role->display_name}}
                                        </td>
                                    @endforeach
                                @endif
                                @if(!auth()->user()->hasRole('user'))
                                    <td class="ml-0">

                                        @if(Cache::has('user-is-online-' . $user->id))
                                            <span class="badge badge-success sm">Online</span>
                                        @else
                                            <span class="badge badge-secondary ml-0">Offline</span>
                                        @endif
                                        <br>


                                    </td>
                                @endif

                                <td>
                                    @if(auth()->user()->hasPermission('users-read'))

                                        <a class="btn btn-primary btn-sm btn-round"
                                           href="{{route('users.show' , $user->id)}}">
                                            <i class="fa fa-book"></i> View</a>

                                    @endif
                                    @if(auth()->user()->hasPermission('users-update'))

                                        <a class="btn btn-warning btn-sm btn-round"
                                           href="{{route('users.edit' , $user->id)}}">
                                            <i class="fa fa-edit"></i> Edit</a>

                                    @endif
                                    @if(auth()->user()->hasPermission('users-delete'))

                                        <button class="btn btn-danger btn-sm btn-round"  data-toggle="modal" data-target="#delete{{$user->id}}">
                                            <i class="fa fa-trash"></i> Delete</button>


                                            <form action="{{ route('users.destroy', $user->id) }}" method="post">
                                                {{ csrf_field() }}
                                                {{ method_field('delete') }}


                                                <div class="modal fade" id="delete{{$user->id}}">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title"><i class="fa fa-warning"></i> Confirm Delete</h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p>Are you sure you want to delete this user  <b>"{{$user->name}}"</b></p>
                                                            </div>
                                                            <div class="modal-footer justify-content-between">

                                                                <button type="button" class="btn btn-success" data-dismiss="modal" >Close</button>


                                                                <button type="submit" class="btn delete btn-danger">Confirm</button>

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

                    {!! $users->links() !!}

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
