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
        $this->middleware('admin');
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
        if($user->email != $request['email']){
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|max:255|unique:users',
            ]);
        }
        else{
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|max:255',
            ]);
        }
        if($request->password != ''){
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
        return redirect()->route('users.index')->with('success','更新使用者資料成功');
    }
    public function destory($id){
        $user = \App\User::findOrFail($id);
        $events = \App\Event::where('user_id','=',$id)->get();
        foreach($events as $event){
            $event->delete();
        }
        $news = \App\News::withTrashed()
                ->where('user_id','=',$id)->get();
        foreach($news as $newstmp){
            $newstmp->forceDelete();
        }
        $losts = \App\Lost::withTrashed()
                ->where('user_id','=',$id)->get();
        foreach($losts as $lost){
            $lost->forceDelete();
        }
        $user->delete();
        return redirect()->route('users.index')->with('success','刪除使用者成功');
    }
}
