@extends('admin.partials.dashboard')

@section('content')

    @if( session()->has('admin_updated') )
    <div class="alert alert-success alert-dismissible" role="alert" id="success-alert" >
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    {{ session()->get('admin_updated') }}
    </div>
    @endif

    <table class="table table-bordered" id="admins">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th class="text-center">Edit</th>
                <th class="text-center">Delete</th>
                <th>Created</th>
            </tr>
        </thead>
        <tbody>
            @foreach($admins as $admin)
            <tr>
                <td>{{ $admin->id }}</td>
                <td>{{ $admin->name }}</td>
                <td>{{ $admin->email }}</td>
                <td>{{ $admin->roleName() }}</td>
                <td class="text-center">
                    <a class="btn btn-primary btn-xs" href="/admin/edit/{{ $admin->id }}">
                        <span class="glyphicon glyphicon-edit" aria-hidden="true"></span> &nbsp; Edit
                    </a>
                </td>
                <td class="text-center">
                    {!! Form::open(['method' => 'delete', 'action' => ['AdminController@destroy', $admin->id] ]) !!}
                        {{--{!! Form::submit('Delete', ['class' => 'form-control btn btn-danger btn-xs']) !!}--}}
                        {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"></span> &nbsp; Delete', array('type' => 'submit', 'class' => 'btn btn-danger btn-xs')) !!}

                    {!! Form::close() !!}
                </td>
                <td>{{ $admin->created_at }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

@stop