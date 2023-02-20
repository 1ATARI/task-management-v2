@extends('includes.dashboard')

@section('title')
    Dashboard
@endsection


@section('styles')

@endsection

@section('content')
    <div class="right_col" role="main">


        <div class="row">
            <div class="x_panel">

                <div class="col-md-12">

                    <!-- price element -->
                    <div class="col-md-3 col-sm-6  ">
                        <div class="pricing">
                            <a href="{{route('users.index')}}">

                                <div class="title">
                                    <h2>Total Users</h2>
                                    <h1>{{$users->count()}}</h1>
                                </div>
                            </a>

                        </div>
                    </div>
                    <!-- price element -->


                    <!-- price element -->
                    <div class="col-md-3 col-sm-6  ">
                        <div class="pricing">
                            <a href="{{route('departments.index')}}">
                                <div class="title">
                                    <h2> Total Departments</h2>
                                    <h1>{{$departments->count()}}</h1>
                                </div>
                            </a>

                        </div>
                    </div>
                    <!-- price element -->


                    <!-- price element -->
                    <div class="col-md-3 col-sm-6  ">
                        <div class="pricing ui-ribbon-container">
                            <a href="{{route('tasks.index')}}">

                                <div class="title">
                                    <h2>Total Tasks</h2>
                                    <h1>{{$tasks->count()}}</h1>
                                </div>
                            </a>

                        </div>
                    </div>
                    <!-- price element -->

                    <!-- price element -->
                    <div class="col-md-3 col-sm-6  ">
                        <div class="pricing">
                            <a href="{{route('tasks.index')}}">

                                <div class="title">
                                    <h2>New Tasks today</h2>
                                    <h1>{{$Dtasks->count()}}</h1>
                                </div>
                            </a>

                        </div>
                    </div>

<br>
                        <div class="x_title mt-5">
                            <h2 class="mt-5">Department Task <small>{{$tasks->count()}}</small></h2>

                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <canvas id="canvasDoughnut-1"></canvas>
                        </div>

                    <!-- price element -->


                </div>
            </div>
        </div>


    </div>
@endsection


@section('js')
    <script src="{{asset('assets/vendors/Chart.js/dist/Chart.min.js')}}"></script>

<script>


        var ctx = document.getElementById("canvasDoughnut-1");
        var data = {
            labels: [

                @foreach($departments as $d)
              "{{$d->name}} task",


                    @endforeach
            ],
            datasets: [{
                data: [
                    @foreach($departments as $d)
                        {{$d->tasks->count()}},


                        @endforeach                ],
                backgroundColor: [
                    "#455C73",
                    "#9B59B6",
                    "#BDC3C7",
                    "#26B99A",
                    "#3498DB",
                    "#37040D",
                    "#000080",
                    "#009f6b",
                    "#678197",
                    "#CD5C5C",
                    "#DFFF00",
                    "#CCCCFF",
                    "#6495ED",
                    "#9FE2BF",
                    "#454545",
                    "#999999",
                    "#000080",

                ],
                hoverBackgroundColor: [
                    "#455C73",
                    "#9B59B6",
                    "#BDC3C7",
                    "#26B99A",
                    "#3498DB",
                    "#37040D",
                    "#000080",
                    "#009f6b",
                    "#678197",
                    "#CD5C5C",
                    "#DFFF00",
                    "#CCCCFF",
                    "#6495ED",
                    "#9FE2BF",
                    "#454545",
                    "#999999",
                    "#000080",

                ]

            }]
        };

        var canvasDoughnut = new Chart(ctx, {
            type: 'doughnut',
            tooltipFillColor: "rgba(51, 51, 51, 0.55)",
            data: data
        });


</script>


@endsection
