@extends('admin.partials.dashboard')

@section('content')


    {{--@if( session()->has('admin_created') )--}}
        {{--<div class="alert alert-success alert-dismissible" role="alert" id="success-alert" >--}}
            {{--<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>--}}
            {{--{{ session()->get('admin_created') }}--}}
        {{--</div>--}}
    {{--@endif--}}

    {!! Form::open(['method' => 'POST', 'route'=> ['admin.update', $admin] ]) !!}

    {!! Form::text('name',  $admin->name , ['class' => 'form-control', 'placeholder'=> 'Name']) !!}
    {!! Form::email('email', $admin->email ,  ['class' => 'form-control', 'placeholder'=> 'Email']) !!}
    {!! Form::submit('Update', ['class' => 'form-control btn btn-primary']) !!}

    {!! Form::close() !!}

    @include('errors.message')

@stop
