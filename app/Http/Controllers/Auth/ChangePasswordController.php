<?php

namespace App\Http\Controllers\Auth;

use Hash;
use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ChangePasswordController extends Controller
{
    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/m';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show(){
        $user = \App\User::find( Auth::user()->id );
        $data = compact('user');
        return view('auth.changepassword', $data);
    }
    
    public function change(Request $request){
        $user = \App\User::find(Auth::user()->id);
        if (!(Hash::check($request->get('oldpassword'), Auth::user()->password))){ 
            return redirect()->back()->with("error","原密碼輸入錯誤！");
        }
        if(strcmp($request->get('oldpassword'), $request->get('password')) == 0){
            return redirect()->back()->with("error","新密碼不能與舊密碼相同！請重新輸入");
        }

        $validatedData = $request->validate([
            'oldpassword' => 'required',
            'password' => 'required|string|min:6|confirmed',
        ]);
        $user->update([
            'password' => bcrypt($request->get('password')),
        ]);
 
        return redirect()->back()->with("success","密碼變更成功");
    }
}
