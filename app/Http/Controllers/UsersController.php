<?php

namespace App\Http\Controllers;

use App\Api\V1\Transformers\UserTransformer;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Dingo\Api\Routing\Helpers;

use App\Http\Requests;

class UsersController extends Controller
{

    use Helpers;

    /**
     * Assign a specific Role to a user
     *
     * @param $user_id
     * @param $role_name
     * @return string
     */
    public function assignUserRole($user_id, $role_name)
    {
        $user = User::find($user_id);
        $role = Role::where('name', $role_name)->first();

        if(! $user ){
            throw new \Symfony\Component\HttpKernel\Exception\NotFoundHttpException('User Not Found!!');
        }

        $user->attachRole($role);

        return 'Role: '. $role->name .' attached to User: ' . $user->name;

    }

    /**
     * Detach a Role from a user
     *
     * @param $user_id
     * @param $role_name
     * @return string
     */
    public function detachUserRole($user_id, $role_name)
    {
        $user = User::find($user_id);
        $role = Role::where('name', $role_name)->first();

        if(! $user ){
            throw new \Symfony\Component\HttpKernel\Exception\NotFoundHttpException('User Not Found!!');
        }

        $user->detachRole($role);

        return 'Role: '. $role->name .' detached from User: ' . $user->name;
    }

    public function getUsers()
    {

        $users = User::all();

        return $this->response->collection($users, new UserTransformer);

    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
