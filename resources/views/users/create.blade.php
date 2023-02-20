@extends('includes.dashboard')

@section('title')

    Create User
@endsection


@section('styles')

@endsection

@section('content')


    <div class="right_col" role="main">

    <div class="row">
        <div class="col-md-12 col-sm-12 ">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Create User </h2>
                    @include('includes.errors')

                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br>
                    <form action="{{route('users.store')}}" method="post" id="demo-form2" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="" enctype="multipart/form-data">
                        {{csrf_field()}}
                        {{method_field('post')}}


                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Name <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                                <input type="text" id="first-name" name="name" required="required" class="form-control" value="{{old('name')}}">
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="Email">Email <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                                <input type="email" id="Email" name="email" required="required" class="form-control" value="{{old('email')}}">
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="Email">Image <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                                <input type="file" name="image" accept="image/*" class=" image">
                            </div>
                        </div>

                            <div class="item form-group text-center">

                            <div class="col-md-6 col-sm-6 ml-5">

                                <img src="{{asset('uploads/users_image/user.png')}}" width="100px" height="100px" class="image img-thumbnail image-preview" >
                            </div>
                        </div>



                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="password">Password <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                                <input type="password" id="password" name="password" required="required" class="form-control ">
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="password_confirmation">Password Confirmation <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                                <input type="password" id="password_confirmation" name="password_confirmation" required="required" class="form-control ">
                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="col-form-label col-md-3 col-sm-3 label-align ">Department</label>
                            <div class="col-md-6 col-sm-6 ">
                                <select class="form-control" name="department_id">
                                    <option selected disabled> Select Department</option>

                                @foreach($deps as $dep)

                                        <option value="{{$dep->id}}" {{old('department_id')==$dep->id?'selected' :''}}>{{$dep->name}}</option>


                                    @endforeach


                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-form-label col-md-3 col-sm-3 label-align ">Role</label>
                            <div class="col-md-6 col-sm-6 ">
                                <select class="form-control" name="role">
                                    <option selected disabled> Select Role</option>

                                    @foreach($roles as $rol)


                                        <option value="{{$rol->name}}" {{old('role') ==$rol->name ? 'selected':'' }}>{{$rol->display_name}}</option>

                                    @endforeach




                                </select>
                            </div>
                        </div>



                        <div class="ln_solid"></div>
                        <div class="item form-group">
                            <div class="col-md-6 col-sm-6 offset-md-3">

                                <button type="submit" class="btn btn-success">Create</button>
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
