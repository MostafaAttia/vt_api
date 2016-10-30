<?php

namespace App\Http\Controllers;

use App\Image;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Session;


class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('role:admin');
    }


    public function welcome()
    {
        return view('admin.partials.dashboard');
    }

    public function manageAdmins()
    {

        $admins = User::whereHas('roles', function($q){
            $q->where('name', 'admin');
        })->get();

        return view('admin.index', compact('admins'))
            ->with(['page_title'=> 'All Admins', 'page_description'=> 'Show, Edit, Update and Delete admins']);
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

        return view('admin.create')
            ->with(['page_title'=> 'Create Admin', 'page_description'=> 'create a new admin']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'name'  => 'required',
            'email' => 'required|email|unique:users,email',
            'password'  => 'required|min:6',
            'image' => 'required|image|max:2048|mimes:jpeg,png,jpg',
        ]);

        if($image = $request->file('image')){

            $imageName = $image->getClientOriginalName();
            $image->move('images', $imageName);
        }

        $image = Image::create([
            'path' => $imageName
        ]);

        $params = $request->only('name', 'email', 'password');
        $params['image_id'] = $image->id;

        $user = User::create($params);

        $admin = Role::where('name', 'admin')->first();
        $user->attachRole($admin);

        Session::flash('admin_created', 'Admin Created Successfully!');

        return redirect('admin/create');
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
        $admin = User::findOrFail($id);

        return view('admin.edit', compact('admin'))
            ->with(['page_title'=> 'Edit Admin']);
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
        $this->validate($request, [
            'name'  => 'required',
            'email' => 'required|email|unique:users,email'
        ]);

        $params = $request->only('name', 'email');
        $name = $params['name'];

        $user = User::findOrFail($id);

        $user->update($request->all());

//        User::update($request->all());

//        $user = User::where('name', $name)->first();
//        $admin = Role::where('name', 'admin')->first();
//        $user->attachRole($admin);

        Session::flash('admin_updated', 'Admin Updated Successfully!');

        return redirect('admin/manage');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        Session::flash('admin_deleted', 'Admin Deleted Successfully!');

        return redirect('admin/manage');
    }
}
