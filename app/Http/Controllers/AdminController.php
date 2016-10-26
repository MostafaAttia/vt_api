<?php

namespace App\Http\Controllers;

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

        return view('admin.index', compact('admins'));
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
        return view('admin.create')->with(['page_title'=> 'Create Admin', 'page_description'=> 'create a new admin']);
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
            'password'  => 'required|min:6'
        ]);

        $params = $request->only('name', 'email', 'password');
        $name = $params['name'];

        User::create($request->all());

        $user = User::where('name', $name)->first();
        $admin = Role::where('name', 'admin')->first();
        $user->attachRole($admin);

        Session::flash('admin_created', 'Admin $name Created Successfully!');

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
