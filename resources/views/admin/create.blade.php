@extends('admin.partials.dashboard')

@section('content')


    @if( session()->has('admin_created') || session()->has('admin_deleted') )
        <div class="alert alert-success alert-dismissible" role="alert" id="success-alert" >
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            {{ session()->get('admin_created') ?  session()->get('admin_created') : session()->get('admin_deleted')}}
        </div>
    @endif



    <div class="row create-users-form">
        <div class="col-sm-2"></div>

        <div class="col-sm-8">


            {!! Form::open(['method' => 'POST', 'url'=> 'admin/create', 'files' => true, 'class'=> 'form-horizontal', 'enctype' => 'multipart/form-data' ]) !!}

            <div class="form-group {{ $errors->has('name') ? 'has-error' :'' }}">
                <label for="name" class="col-sm-2 control-label">Name</label>
                <div class="col-sm-10">
                    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder'=> 'Name', 'id' => 'name']) !!}
                </div>
            </div>

            <div class="form-group {{ $errors->has('email') ? 'has-error' :'' }}">
                <label for="email" class="col-sm-2 control-label">Email</label>
                <div class="col-sm-10">
                    {!! Form::email('email', null, ['class' => 'form-control', 'placeholder'=> 'Email', 'id' => 'email']) !!}
                </div>
            </div>

            <div class="form-group {{ $errors->has('password') ? 'has-error' :'' }}">
                <label for="password" class="col-sm-2 control-label">Password</label>
                <div class="col-sm-10">
                    {!! Form::password('password', ['class' => 'form-control', 'placeholder'=> 'Password', 'id' => 'password']) !!}
                </div>
            </div>

            <div class="form-group {{ $errors->has('image') ? 'has-error' :'' }}">
                <label for="image" class="col-sm-2 control-label">Image</label>
                <div class="col-sm-10">
                    {!! Form::file('image', ['class' => 'form-control']) !!}
                </div>
            </div>

            <div class="form-group">
                <span class="col-sm-2"></span>
                <div class="col-sm-10">
                    {!! Form::submit('Add', ['class' => 'form-control inputfields btn btn-primary']) !!}
                </div>
            </div>

            {!! Form::close() !!}

            <div class="row">
                <span class="col-sm-2"></span>
                <div class="col-sm-10">
                    @include('errors.message')
                </div>
            </div>


        </div>

        <div class="col-sm-2"></div>

    </div>


    

@stop
