<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        $users = \App\User::all();
        $data = compact('users');
        return view('m.users.index', $data);
    }

    public function edit($id){
        $user = \App\User::findOrFail($id);
        $data = compact('user');
        return view('m.users.edit', $data);
    }

    public function update($id, Request $request){
        $user = \App\User::findOrFail($id);
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'school' => 'required|string|max:255',
            'group' => 'required|string|max:255',
        ]);
        if($request->password == ''){
            $validatedData = $request->validate([
                'password' => 'required|string|min:6|confirmed',
            ]);
            $user->update([
                'password' => bcrypt($request['password']),
            ]);
        }
        $user->update([
            'name' => $request['name'],
            'email' => $request['email'],
            'school' => $request['school'],
            'group' => $request['group'],
            'note' => $request['note'],
        ]);
        return redirect()->route('users.index');
    }
    public function delete($id){
        $user = \App\User::findOrFail($id);
        $user->delete();
        return redirect()->route('users.index');
    }
}
