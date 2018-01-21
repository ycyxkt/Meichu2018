<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Gate;

use Illuminate\Http\File;
use \Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;

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
                ->select('teams.*')
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
            $tmpid = $lastid->id+1;
        }
        else{
            $tmpid = 1;
        }
        $validatedData = $request->validate([
            'file_logo' => 'image|mimes:jpeg,png,jpg,gif|max:5000',
            'file_photo' => 'image|mimes:jpeg,png,jpg,gif|max:5000',
            'link_website' => 'nullable|url',
            'link_facebook' => 'nullable|url',
            'link_instagram' => 'nullable|url',
            'introduction' => 'nullable|string|max:120',
        ]);
        if($request->hasFile('file_logo')){
            $image = Image::make($request->file('file_logo'));
            $image->resize(200, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $request['logo'] = 'team-logo-'.$tmpid.'.'.$request->file('file_logo')->getClientOriginalExtension();
            $destinationPath = public_path('images');
            $image->save($destinationPath.'/'.$request['logo']);
        }
        if($request->hasFile('file_photo')){
            $image = Image::make($request->file('file_photo'));
            $image->resize(600, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $request['photo'] = 'team-photo-'.$tmpid.'.'.$request->file('file_photo')->getClientOriginalExtension();
            $destinationPath = public_path('images');
            $image->save($destinationPath.'/'.$request['photo']);
        }
        \App\Team::create($request->except('file_logo','file_photo'));
        return redirect()->route('teams.index')->with('success','建立隊伍成功');
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
        $data = compact('team');

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
            return redirect()->route('teams.index')->with('error','您沒有權限編輯');
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
            return redirect()->route('teams.index')->with('error','您沒有權限編輯');
        }
        $validatedData = $request->validate([
            'file_logo' => 'image|mimes:jpeg,png,jpg,gif|max:5000',
            'file_photo' => 'image|mimes:jpeg,png,jpg,gif|max:5000',
            'link_website' => 'nullable|url',
            'link_facebook' => 'nullable|url',
            'link_instagram' => 'nullable|url',
            'introduction' => 'nullable|string|max:120',
        ]);
        if($request->hasFile('file_logo')){
            if($team->logo != NULL && file_exists(public_path('images/').$team->logo)){
                unlink(public_path('images/').$team->logo);
            }
            $image = Image::make($request->file('file_logo'));
            $image->resize(200, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $request['logo'] = 'team-logo-'.$id.'.'.$request->file('file_logo')->getClientOriginalExtension();
            $destinationPath = public_path('images');
            $image->save($destinationPath.'/'.$request['logo']);
        }
        if($request->hasFile('file_photo')){
            if($team->photo != NULL && file_exists(public_path('images/').$team->photo)){
                unlink(public_path('images/').$team->photo);
            }
            $image = Image::make($request->file('file_photo'));
            $image->resize(600, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $request['photo'] = 'team-photo-'.$id.'.'.$request->file('file_photo')->getClientOriginalExtension();
            $destinationPath = public_path('images');
            $image->save($destinationPath.'/'.$request['photo']);
        }
        $team->update($request->except('file_logo','file_photo'));
        return redirect()->route('teams.show',$team->id)->with('success','更新隊伍資訊成功');
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
        if (Gate::allows('edit-team', $team)) {
            $team->delete();
            return redirect()->route('teams.index')->with('success','刪除隊伍成功');
        }
        return redirect()->route('teams.index')->with('error','您沒有權限刪除');
    }
}
