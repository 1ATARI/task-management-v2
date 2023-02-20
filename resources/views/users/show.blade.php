@extends('includes.dashboard')

@section('title')
    {{$user->name}}
@endsection


@section('styles')

@endsection

@section('content')



    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>User Profile</h3>
                </div>

            </div>

            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12 col-sm-12 ">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>User Report <small>Activity report</small></h2>

                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <div class="col-md-3 col-sm-3  profile_left">
                                <div class="profile_img">
                                    <div id="crop-avatar">
                                        <!-- Current avatar -->
                                        <img class="img-responsive avatar-view " width="200px" height="200px" src="{{$user->image_path}}" alt="Avatar" title="Change the avatar">
                                    </div>
                                </div>
                                <h3>{{$user->name}}</h3>

                                <ul class="list-unstyled user_data">


                                    <li>
                                        <i class="fa fa-briefcase user-profile-icon"></i> @foreach($user->roles as $role) {{$role->display_name}} @endforeach
                                    </li>

                                    <li class="m-top-xs">
                                        <i class="fa  fa-calendar user-profile-icon"> {{$user->created_at->format('d M Y')}}</i>

                                    </li>
                                    <li class="m-top-xs">
                                        <i class="fa fa-mail-forward"> {{$user->email}}</i>

                                    </li>

                                </ul>

                                <a class="btn btn-success" href="{{route('users.edit' , $user->id)}}"><i class="fa fa-edit m-right-xs"></i>Edit Profile</a>
                                <br />

                                <!-- start skills -->
                                <h4>Skills</h4>
                                <ul class="list-unstyled user_data">
                                    <li>
                                        <p>Tasks {{$user->task_count}}</p>
                                        <div class="progress progress_sm">
                                            <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="{{$user->task_count}}"></div>
                                        </div>
                                    </li>

                                </ul>
                                <!-- end of skills -->

                            </div>
                            <div class="col-md-9 col-sm-9 ">



                                <div class="" role="tabpanel" data-example-id="togglable-tabs">
                                    <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                                        <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Today task</a>
                                        </li>
                                        <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Department</a>
                                        </li>

                                    </ul>
                                    <div id="myTabContent" class="tab-content">
                                        <div role="tabpanel" class="tab-pane active " id="tab_content1" aria-labelledby="home-tab">

                                            <!-- start recent activity -->
                                            <ul class="messages">
                                                @if($Dtasks->count() >0)

                                                @foreach($Dtasks as $task)
                                                    <li class="mt-0">
                                                        <div class="message_date">
                                                            <h3 class="date text-info">{{$task->created_at->format('d ')}}</h3>
                                                            <p class="month">{{$task->created_at->format('M')}}</p>
                                                        </div>
                                                        <div class="message_wrapper">
                                                            <h4 class="heading">{{$task->title}}</h4>
                                                            <blockquote class="message">{!! Str::limit($task->body , 50)!!}</blockquote>
                                                            <br />
                                                            <p class="url">
                                                                <span class="fs1 text-info" aria-hidden="true" data-icon=""></span>
                                                            </p>
                                                        </div>
                                                    </li>
                                                @endforeach
                                                @else
                                                    <h4 class="">There is no new task created today by {{$user->name}}</h4>
                                                @endif


                                            </ul>
                                            <!-- end recent activity -->

                                        </div>
                                        <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">

                                            <!-- start user projects -->

                                            <ul class="messages">

                                                <li class="mt-0">

                                                    <div class="message_wrapper">
                                                        <a href="{{route('departments.show' , $user->department->id)}}">
                                                            <h4 class="heading">{{$user->department->name}}</h4>
                                                            <blockquote class="message">{!! Str::limit($user->department->description , 100)!!}</blockquote>
                                                        </a>
                                                        <br />
                                                        <p class="url">
                                                            <span class="fs1 text-info" aria-hidden="true" data-icon=""></span>
                                                        </p>
                                                    </div>
                                                </li>



                                            </ul>

                                            <!-- end user projects -->

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>





@endsection
@section('js')



@endsection
