<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Gate;
use Cache;

use Imgur;
use Illuminate\Http\File;
use \Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;

use App\Lost;
use App\Repositories\LostRepository;

class LostsController extends Controller
{

    public function __construct()
    {
        $this->lostRepository = new LostRepository(new Lost);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->group == 'committee'){
            $query = \App\Lost::join('users', 'users.id', '=', 'losts.user_id')
                    ->where('users.group', '=', 'committee')
                    ->select('losts.*');
        }
        elseif(Auth::user()->group == 'admin'){
            $query = \App\Lost::withTrashed();
        }
        else {
            $query = \App\Lost::where('user_id', '=', Auth::user()->id);
        }
        $losts = $query->orderBy('id','asc')
                ->get();
        $data = compact('losts');
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
                ->select('name')
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
            'title' => 'required|string|max:10',
            'date' => 'date|before:'.date('Y-m-d',strtotime(date('Y-m-d') . '+1 days')).'|after:"2018-01-01"',
            'file_photo' => 'image|mimes:jpeg,png,jpg|max:5000',
            'content' => 'nullable|string|max:100',
        ]);

        if($request->hasFile('file_photo')){
            /*
            $image = Image::make($request->file('file_photo'));
            $image->resize(400, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $request['photo'] = 'lost-photo-'.$tmpid.'.'.$request->file('file_photo')->getClientOriginalExtension();
            $destinationPath = public_path('images');
            $image->save($destinationPath.'/'.$request['photo']);
            */
            $image = Imgur::upload($request->file('file_photo'));
            $request['photo'] = Imgur::size($image->link(), 'm');
        }
        $request['user_id']=Auth::user()->id;
        \App\Lost::create($request->except('file_photo'));
        return redirect()->route('losts.index')->with('success','新增遺失物成功');
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
            $lost = \App\Lost::find($id);
        }
        if (Gate::denies('edit-losts', $lost)) {
            return redirect()->route('losts.index')->with('error','您沒有權限查看');
        }
        $data = compact('lost');

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
            return redirect()->route('losts.index')->with('error','您沒有權限編輯');
        }
        $games = \App\Game::orderBy('date','asc')
                ->orderBy('time','asc')
                ->select('name')
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
            return redirect()->route('losts.index')->with('error','您沒有權限編輯');
        }
        $validatedData = $request->validate([
            'title' => 'required|string|max:10',
            'date' => 'date|before:'.date('Y-m-d',strtotime(date('Y-m-d') . '+1 days')).'|after:"2018-01-01"',
            'file_photo' => 'image|mimes:jpeg,png,jpg|max:5000',
            'content' => 'nullable|string|max:100',
        ]);
        if($request->hasFile('file_photo')){
            /*
            if($lost->photo != NULL && file_exists(public_path('images/').$lost->photo)){
                unlink(public_path('images/').$lost->photo);
            }
            $image = Image::make($request->file('file_photo'));
            $image->resize(400, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $request['photo'] = 'lost-photo-'.$id.'.'.$request->file('file_photo')->getClientOriginalExtension();
            $destinationPath = public_path('images');
            $image->save($destinationPath.'/'.$request['photo']);
            */
            $image = Imgur::upload($request->file('file_photo'));
            $request['photo'] = Imgur::size($image->link(), 'm');
        }
        $lost->update($request->except('file_photo'));
        return redirect()->route('losts.show',$id)->with('success','更新遺失物資訊成功');
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
            return redirect()->route('losts.index')->with('success','刪除遺失物成功');
        }
        return redirect()->route('losts.index')->with('error','您沒有權限刪除');
    }


    /**
     * 前台的遺失物列表
     *
     * @return view
     */
    public function index_front()
    {
        $losts = Cache::remember('LOST:LOST', 10, function() {
            return $this->lostRepository->getLosts();
        });

        $data = compact('losts');
        return view('losts', $data);
    }
}
