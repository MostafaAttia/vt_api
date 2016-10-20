<?php

namespace App\Http\Controllers;

use App\Permission;
use App\Role;
use Illuminate\Http\Request;
use Dingo\Api\Routing\Helpers;

use App\Http\Requests;

class RolesController extends Controller
{

    use Helpers;

    public function __construct()
    {
        $this->middleware('api.auth');
    }

    /**
     * Attach a permission to a role,
     * given the name of each
     *
     * @param $role_name
     * @param $perm_name
     * @return array|string
     */
    public function attachRolePermission($role_name, $perm_name)
    {
        $perm = Permission::where('name', $perm_name)->first();
        $role = Role::where('name', $role_name)->first();

        if(! $perm ){
            throw new \Symfony\Component\HttpKernel\Exception\NotFoundHttpException('Permission Not Found, Please check the name!');
        }
        if(! $role ){
            throw new \Symfony\Component\HttpKernel\Exception\NotFoundHttpException('Role Not Found, Please check the name!');
        }
        $role->attachPermission($perm);
        return 'Permission: '. $perm->name . ' has been attached to Role: ' . $role->name;
    }

    /**
     * Detach a permission from a role,
     * given the name of each
     *
     * @param $role_name
     * @param $perm_name
     * @return array|string
     */
    public function detachRolePermission($role_name, $perm_name)
    {
        $perm = Permission::where('name', $perm_name)->first();
        $role = Role::where('name', $role_name)->first();

        if(! $perm ){
            throw new \Symfony\Component\HttpKernel\Exception\NotFoundHttpException('Permission Not Found, Please check the name!');
        }
        if(! $role ){
            throw new \Symfony\Component\HttpKernel\Exception\NotFoundHttpException('Role Not Found, Please check the name!');
        }

        $role->perms()->detach($perm);

        return 'Permission: '. $perm->name .' has been detached from Role: ' . $role->name;
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
        $params = $request->only('name', 'display_name', 'description');

        $name = $params['name'];
        $display_name = $params['display_name'];
        $description = $params['description'];

        $role = new Role();
        $role->name = $name;
        $role->display_name = $display_name;
        $role->description = $description;
        $role->save();

        return $this->response->created();
//        return 'Role \''. $name . '\' Created';
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
     *  update role by name
     * @param Request $request
     * @param $name
     * @return string
     */
    public function updateRole(Request $request, $name)
    {
        $params = $request->only('name', 'display_name', 'description');
        $role = Role::where('name',$name)->update($params);

        if(! $role ){
            throw new \Symfony\Component\HttpKernel\Exception\NotFoundHttpException('Role Not Found, Please check the name!');
        }
        return 'Role Updated!';
    }

    public function deleteRole($name)
    {
        $role = Role::where('name', $name)->delete();
        if(! $role ){
            return array(
                'message'   => 'Role Not Found, Please Check The Name',
                'code'      => 404
            );
        }
        return 'Role Deleted';
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
