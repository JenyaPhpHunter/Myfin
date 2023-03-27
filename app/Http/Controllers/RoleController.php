<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $auth_user = Auth::user();
        $roles = Role::query()->with('users')->orderBy('id')->get();
        return view('roles.index',[
            "roles" => $roles,
            "user" => $auth_user,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('roles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:roles|max:35',
        ]);

        $role = new Role();
        $role->name = $request->post('name');

        $role->save();

        return redirect(route('roles.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $auth_user = Auth::user();
        $role= Role::query()->with('users')
            ->where('id',$id)->first();
        return view('roles.show',[
            'role' => $role,
            'user' => $auth_user,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::query()->with('users')->where('id',$id)->first();
        if(!$role){
            throw new \Exception('User not found');
        }
        return view('roles.edit', ['role' => $role]);
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
        $validated = $request->validate([
            'name' => 'required|unique:roles|max:35',
        ]);

        $role = Role::query()->where('id',$id)->first();
        $role->name = $request->post('name');

        $role->save();

        return redirect( route('roles.show', ['role' => $id]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = Role::query()->where('id',$id)->delete();
        return redirect( route('roles.index'));
    }
}
