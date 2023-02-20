@extends('includes.dashboard')

@section('title')

    Create Task
@endsection


@section('styles')

@endsection

@section('content')


    <div class="right_col" role="main">

        <div class="row">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Create task </h2>
                        @include('includes.errors')

                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <br>
                        <form action="{{route('tasks.update' , $task->id)}}" method="post" id="demo-form2" data-parsley-validate="" class="form-horizontal form-label-left" >
                            {{csrf_field()}}
                            {{method_field('PUT')}}


                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="title">Title <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 ">
                                    <input type="text" id="title" name="title" required="required" class="form-control" value="{{$task->title}}">
                                </div>
                            </div>




                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="body">Body <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 ">
                                    <textarea type="text" id="body" name="body" required="required" class="form-control ckeditor" >{{$task->body}}</textarea>
                                </div>
                            </div>


                            <div class="form-group row">
                                <label class="col-form-label col-md-3 col-sm-3 label-align ">For Department</label>
                                <div class="col-md-6 col-sm-6 ">
                                    <select class="form-control" name="department_id">
                                        <option selected disabled> Select Department</option>

                                        @foreach($departments as $dep)

                                            <option value="{{$dep->id}}" {{$task->department_id==$dep->id?'selected' :''}}>{{$dep->name}}</option>


                                        @endforeach


                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-form-label col-md-3 col-sm-3 label-align ">Status</label>
                                <div class="col-md-6 col-sm-6 ">
                                    <select class="form-control" name="status">


                                            <option  value="In progress" {{$task->status=='In progress'?'selected' :''}}>In progress</option>
                                            <option value="Completed" {{$task->status=='Completed'?'selected' :''}}>Completed</option>




                                    </select>
                                </div>
                            </div>



                            <div class="ln_solid"></div>
                            <div class="item form-group">
                                <div class="col-md-6 col-sm-6 offset-md-3">

                                    <button type="submit" class="btn btn-success">Update</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>



@endsection


@section('js')


@endsection
