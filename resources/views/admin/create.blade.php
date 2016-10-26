@extends('admin.partials.dashboard')

@section('content')


    @if( session()->has('admin_created') )
        <div class="alert alert-success alert-dismissible" role="alert" id="success-alert" >
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            {{ session()->get('admin_created') }}
        </div>
    @endif
    
    {!! Form::open(['method' => 'POST', 'url'=> 'admin/create']) !!}

    	{!! Form::text('name', null, ['class' => 'form-control', 'placeholder'=> 'Name']) !!}
        {!! Form::email('email', null,  ['class' => 'form-control', 'placeholder'=> 'Email']) !!}
        {!! Form::password('password', ['class' => 'form-control', 'placeholder'=> 'Password']) !!}
        {!! Form::submit('Add', ['class' => 'form-control btn btn-primary']) !!}

    {!! Form::close() !!}

    @include('errors.message')

@stop
