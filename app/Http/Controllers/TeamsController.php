<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use \Illuminate\Support\Facades\Storage;
use Gate;

class TeamsController extends Controller
{

    public function __construct(){
        $this->middleware('committee');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teams = \App\Team::join('games', 'teams.game', '=', 'games.game')
                ->orderBy('date','asc')
                ->orderBy('time','asc')
                ->select('games.name as gamename','teams.*')
                ->get();
        $data = compact('teams');
        return view('m.teams.index', $data);
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
        return view('m.teams.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $lastid = \App\Team::latest()->first();
        if($lastid != NULL){
            $id = $lastid->id+1;
        }
        else{
            $id = 1;
        }
        $validatedData = $request->validate([
            'file_logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5000',
            'file_photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5000',
            'link_website' => 'nullable|url',
            'link_facebook' => 'nullable|url',
            'link_instagram' => 'nullable|url',
            'introduction' => 'nullable|string|max:120',
        ]);
        if($request->hasFile('file_logo')){
            $image = $request->file('file_logo');
            $input['imagename'] = 'team-logo-'.$id.'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $input['imagename']);
            $request['logo'] = '/images/'.$input['imagename'];
        }
        if($request->hasFile('file_photo')){
            $image = $request->file('file_photo');
            $input['imagename'] = 'team-photo-'.$id.'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $input['imagename']);
            $request['photo'] = '/images/'.$input['imagename'];
        }
        \App\Team::create($request->except('file_logo','file_photo'));
        return redirect()->route('teams.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $team = \App\Team::findOrFail($id);
        $game = $team->game()->first();
        $data = compact('team','game');

        return view('m.teams.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $team = \App\Team::findOrFail($id);
        if (Gate::denies('edit-team', $team)) {
            return redirect()->route('teams.index');
        }
        $games = \App\Game::orderBy('date','asc')
                ->orderBy('time','asc')
                ->select('name','game')
                ->get();
        $data = compact('team','games');

        return view('m.teams.edit', $data);
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
        $team = \App\Team::findOrFail($id);
        if (Gate::denies('edit-team', $team)) {
            return redirect()->route('teams.index');
        }
        $validatedData = $request->validate([
            'file_logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5000',
            'file_photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5000',
            'link_website' => 'nullable|url',
            'link_facebook' => 'nullable|url',
            'link_instagram' => 'nullable|url',
            'introduction' => 'nullable|string|max:120',
        ]);
        if($request->hasFile('file_logo')){
            if($team->logo != NULL && file_exists(public_path('').$team->logo)){
                unlink(public_path('').$team->logo);
            }
            $image = $request->file('file_logo');
            $input['imagename'] = 'team-logo-'.$id.'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $input['imagename']);
            $request['logo'] = '/images/'.$input['imagename'];
        }
        if($request->hasFile('file_photo')){
            if($team->photo != NULL && file_exists(public_path('').$team->photo)){
                unlink(public_path('').$team->photo);
            }
            $image = $request->file('file_photo');
            $input['imagename'] = 'team-photo-'.$id.'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $input['imagename']);
            $request['photo'] = '/images/'.$input['imagename'];
        }
        $team->update($request->except('file_logo','file_photo'));
        return redirect()->route('teams.show',$team->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $team = \App\Team::findOrFail($id);
        if (Gate::denies('edit-team', $team)) {
            return redirect()->route('teams.index');
        }
        $team->delete();
        return redirect()->route('teams.index');
    }
}
