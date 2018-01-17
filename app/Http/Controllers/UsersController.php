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
        $user = \App\User::find($id);
        $data = compact('user');
        return view('m.users.edit', $data);
    }
    public function update($id, Request $data){
        
        /*// validate
        // read more on validation at http://laravel.com/docs/validation
        $rules = array(
            'name'       => 'required',
            'email'      => 'required|email',
            'nerd_level' => 'required|numeric'
        );
        $validator = Validator::make(Input::all(), $rules);
        

        // process the login
        if ($validator->fails()) {
            return Redirect::to('nerds/' . $id . '/edit')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {*/
            // store
            $user = \App\User::find($id);
            
        $user->update([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'school' => $data['school'],
            'group' => $data['group'],
            'note' => $data['note'],
        ]);
        return Redirect::to('m/users');
    }
    public function delete($id){
        $user = \App\User::find($id);
        $user->delete();
        return redirect()->route('users.index');
    }
}
