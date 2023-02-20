@extends('includes.dashboard')

@section('title')
    {{$task->title}}
@endsection


@section('styles')

@endsection

@section('content')

    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Task Details </h3>
                </div>


            </div>

            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>{{$task->title}} task</h2>

                            <div class="clearfix"></div>
                        </div>

                        <div class="x_content">

                            <div class="col-md-9 col-sm-9  ">

                                <ul class="stats-overview">
                                    <li>
                                        <span class="name"> Created by </span>
                                        <span class="value text-success"> {{$task->user->name}} </span>
                                    </li>


                                    <li>
                                        <span class="name"> Department </span>
                                        <span class="value text-success"> {{$task->department->name}} </span>
                                    </li>


                                    <li class="hidden-phone">
                                        <span class="name"> Data Created </span>
                                        <span
                                            class="value text-success"> {{$task->created_at->format('d M Y')}}  </span>
                                    </li>

                                </ul>
                                <br/>
                                <div class="card-title">
                                    <h5>Task description</h5>
                                    <hr>
                                </div>


                                <div class="card-body ">
                                    <h4>
                                        {!! $task->body !!}</h4>
                                </div>
                                <div class="mt-5">
                                    <h4>User task info</h4><br>
                                    <hr class="mt-0">

                                    <ul class="messages">
                                        <li>

                                            <img src="{{$task->user->image_path}}" class="avatar" alt="Avatar">
                                            <div class="message_date">
                                                <h3 class="date text-info">{{$task->user->task_count}}</h3>
                                                <p class="month">Task</p>
                                            </div>
                                            <div class="message_wrapper">
                                                <h4 class="heading">{{$task->user->name}}
                                                    <small>@foreach($task->user->roles as $role)
                                                            ({{$role->display_name}})
                                                        @endforeach</small></h4>
                                                <blockquote class="message">{{$task->user->email}}</blockquote>
                                                <br/>
                                                <p class="url">
                                                    <span class="fs1 text-info" aria-hidden="true" data-icon=""></span>
                                                    <a href="{{route('users.show' , $task->user->id)}}"><i
                                                            class="fa fa-paperclip"></i> See Profile </a>
                                                </p>
                                            </div>
                                        </li>


                                    </ul>


                                </div>


                            </div>


                            <!-- start project-detail sidebar -->
                            <!-- end project-detail sidebar -->

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('scripts')


@endsection
