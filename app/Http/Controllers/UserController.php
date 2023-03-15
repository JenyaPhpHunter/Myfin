<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Support\Collection
     */
    public function index()
    {
        $users = User::query()->with('role')->orderBy('id', 'desc')->get();
        return view('users.index',[
            "users" => $users,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:users|max:15',
            'email' => 'required',
            'password' => 'required',
            'created_at' => 'nullable|date_format:Y-m-d H:i:s',
            'role_id' => 'required',
        ]);

        $user = new User();
        $user->name = $request->post('name');
        $user->email = $request->post('email');
        $user->password = $request->post('password');
        $user->balance = $request->post('balance');
        $user->created_at = date("Y-m-d H:i:s");
        $user->role_id = $request->post('role_id');

        $user->save();

        return redirect(route('users.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::query()->with('role')
            ->where('id',$id)->first();
        return view('users.show',[
            'user' => $user,
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
        $user = User::query()->where('id',$id)->first();
        if(!$user){
            throw new \Exception('User not found');
        }
        return view('users.edit', ['user' => $user]);
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
            'name' => 'required|unique:users|max:15',
            'email' => 'required',
            'password' => 'required',
            'created_at' => 'nullable|date_format:Y-m-d H:i:s',
            'role_id' => 'required',
        ]);

        $user = User::query()->where('id',$id)->first();
        $user->name = $request->post('name');
        $user->email = $request->post('email');
        $user->password = $request->post('password');
        $user->balance = $request->post('balance');
        $user->created_at = date("Y-m-d H:i:s");
        $user->role_id = $request->post('role_id');

        $user->save();

        return redirect( route('users.show', ['user' => $id]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::query()->where('id',$id)->delete();
        return redirect( route('users.index'));
    }
}
