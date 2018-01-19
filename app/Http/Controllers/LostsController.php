<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Gate;

use Illuminate\Http\File;
use \Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;

class LostsController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->group == 'committee'){
            $query = \App\Losts::join('users', 'users.id', '=', 'losts.user_id')
                    ->where('group', '=', Auth::user()->group)
                    ->select('losts.*');
        }
        if(Auth::user()->group == 'admin'){
            $query = \App\Lost::withTrashed();
        }
        else {
            $query = \App\Lost::where('user_id', '=', Auth::user()->id);
        }
        $losts = $query->orderBy('id','asc')
                ->get();
        $games = \App\Game::orderBy('date','asc')
                ->orderBy('time','asc')
                ->select('name','game')
                ->get();
        $data = compact('losts','games');
        return view('m.losts.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $games = \App\Game::orderBy('date','asc')
                ->orderBy('time','asc')
                ->select('name','game')
                ->get();
        $data = compact('games');
        return view('m.losts.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $lastid = \App\Lost::latest()->first();
        if($lastid != NULL){
            $tmpid = $lastid->id+1;
        }
        else{
            $tmpid = 1;
        }
        $validatedData = $request->validate([
            'date' => 'date|before:'.date('Y-m-d',strtotime(date('Y-m-d') . '+1 days')).'|after:"2018-01-01"',
            'file_photo' => 'image|mimes:jpeg,png,jpg|max:5000',
            'content' => 'nullable|string|max:80',
        ]);
        if($request->hasFile('file_photo')){
            $image = Image::make($request->file('file_photo'));
            $image->resize(400, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $input['imagename'] = 'lost-photo-'.$tmpid.'.'.$request->file('file_photo')->getClientOriginalExtension();
            $destinationPath = public_path('images');
            $image->save($destinationPath.'/'.$input['imagename']);
            $request['photo'] = '/images/'.$input['imagename'];

        }
        $request['user_id']=Auth::user()->id;
        \App\Lost::create($request->except('file_photo'));
        return redirect()->route('losts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(Auth::user()->group == 'admin'){
            $lost = \App\Lost::withTrashed()
                    ->find($id);
        }
        else{
            $lost = \App\Losts::find($id);
        }
        if (Gate::denies('edit-losts', $lost)) {
            return redirect()->route('losts.index');
        }
        $games = \App\Game::orderBy('date','asc')
                ->orderBy('time','asc')
                ->select('name','game')
                ->get();
        $data = compact('lost','games');

        return view('m.losts.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $lost = \App\Lost::find($id);
        if (Gate::denies('edit-losts', $lost)) {
            return redirect()->route('losts.index');
        }
        $games = \App\Game::orderBy('date','asc')
                ->orderBy('time','asc')
                ->select('name','game')
                ->get();
        $data = compact('lost','games');

        return view('m.losts.edit', $data);
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
        $lost = \App\Lost::findOrFail($id);
        if (Gate::denies('edit-losts', $lost)) {
            return redirect()->route('losts.index');
        }
        $validatedData = $request->validate([
            'date' => 'date|before:'.date('Y-m-d',strtotime(date('Y-m-d') . '+1 days')).'|after:"2018-01-01"',
            'file_photo' => 'image|mimes:jpeg,png,jpg|max:5000',
            'content' => 'nullable|string|max:80',
        ]);
        if($request->hasFile('file_photo')){
            if($lost->photo != NULL && file_exists(public_path('').$lost->photo)){
                unlink(public_path('').$lost->photo);
            }
            $image = Image::make($request->file('file_photo'));
            $image->resize(400, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $input['imagename'] = 'lost-photo-'.$id.'.'.$request->file('file_photo')->getClientOriginalExtension();
            $destinationPath = public_path('images');
            $image->save($destinationPath.'/'.$input['imagename']);
            $request['photo'] = '/images/'.$input['imagename'];
        }
        $request['user_id']=Auth::user()->id;
        $lost->update($request->except('file_photo'));
        return redirect()->route('losts.show',$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $lost = \App\Lost::findOrFail($id);
        if (Gate::allows('edit-losts', $lost)) {
            $lost->delete();
        }
        return redirect()->route('losts.index');
    }
}
