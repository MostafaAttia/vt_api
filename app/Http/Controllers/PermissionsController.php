<?php

namespace App\Http\Controllers;

use App\Api\V1\Transformers\PermissionsTransformer;
use App\Permission;
use Illuminate\Http\Request;
use Dingo\Api\Routing\Helpers;

use App\Http\Requests;

class PermissionsController extends Controller
{

    use Helpers;

    public function __construct()
    {
        $this->middleware('api.auth');
    }

    public function getPermissions()
    {
        $perms = Permission::paginate(4);
        return $this->response->paginator($perms, new PermissionsTransformer );
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

        $perm = new Permission();
        $perm->name = $name;
        $perm->display_name = $display_name;
        $perm->description = $description;
        $perm->save();

        return $this->response->created();
//        return 'Permission \''. $name . '\' has been Created';
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
     * @param Request $request
     * @param $name
     * @return string
     */
    public function updatePermission(Request $request, $name)
    {
        $params = $request->only('name', 'display_name', 'description');
        $perm = Permission::where('name', $name)->update($params);
        if(! $perm ){
            return 'Permission Not Found, Please check the name!';
        }
        return 'Permission Updated!';
    }

    public function deletePermission($name)
    {
        Permission::where('name', $name)->firstOrFail()->delete();
        return 'Permission Deleted';
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
