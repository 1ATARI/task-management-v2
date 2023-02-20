@extends('includes.dashboard')

@section('title')
    {{$department->name}}
@endsection


@section('styles')

@endsection

@section('content')


    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Department Details </h3>
                </div>


            </div>

            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>{{$department->name}} Department</h2>

                            <div class="clearfix"></div>
                        </div>

                        <div class="x_content">

                            <div class="col-md-9 col-sm-9  ">

                                <ul class="stats-overview">
                                    <li>
                                        <span class="name"> Department Member </span>
                                        <span class="value text-success"> {{$department->users->count()}} </span>
                                    </li>


                                    <li>
                                        <span class="name"> Total Managers </span>
                                        <span class="value text-success"> {{$manager->count()}} </span>
                                    </li>


                                    <li class="hidden-phone">
                                        <span class="name"> Total Admin </span>
                                        <span class="value text-success"> {{$admin->count()}} </span>
                                    </li>


                                </ul>
                                <br />


                                <div class="card-body">
                                    <h4>
                                    {!! $department->description !!}</h4>

                                </div>





                                <br>
                                <br>
                                <br>
                                <br>
                                <div>


                                    <h4>Department Member</h4><br>
                                    <hr class="mt-0">

                                    <ul class="messages">
                                        @if($department->users->count() > 0)

                                        @foreach($department->users as $user)




                                        <li>

                                            <img src="{{$user->image_path}}" class="avatar" alt="Avatar">
                                            <div class="message_date">
                                                <h3 class="date text-info">{{$user->task_count}}</h3>
                                                <p class="month">Task</p>
                                            </div>
                                            <div class="message_wrapper">
                                                <h4 class="heading">{{$user->name}} <small>@foreach($user->roles as $role)({{$role->display_name}}) @endforeach</small></h4>
                                                <blockquote class="message">{{$user->email}}</blockquote>
                                                <br />
                                                <p class="url">
                                                    <span class="fs1 text-info" aria-hidden="true" data-icon=""></span>
                                                    <a href="{{route('users.show' , $user->id)}}"><i class="fa fa-paperclip"></i> See Profile </a>
                                                </p>
                                            </div>
                                        </li>
                                        @endforeach




                                    </ul>
                                    @else
                                        <h6 class="text-warning"> No members found</h6>
                                    @endif


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
