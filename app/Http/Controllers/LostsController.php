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
        $losts = $query->orderBy('id','desc')
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

        $validatedData = $request->validate([
            'title' => 'required|string|max:10',
            'date' => 'date|before:'.date('Y-m-d',strtotime(date('Y-m-d') . '+1 days')).'|after:"2018-01-01"',
            'file_photo' => 'image|mimes:jpeg,png,jpg|max:5000',
            'content' => 'nullable|string|max:100',
        ]);

        /** 如果有上傳圖片的話 */
        if($request->hasFile('file_photo'))
        {
            $image = Imgur::upload($request->file('file_photo'));
            $request['photo'] = Imgur::size($image->link(), 'l');
        }

        $request['user_id'] = Auth::user()->id;

        Lost::create($request->except('file_photo'));

        /** 更新快取 */
        Cache::tags('LOST')->flush();

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

        $lost = ( 'admin' === Auth::user()->group )
            ? $this->lostRepository->getLostWithTrashed($id)
            : $this->lostRepository->getLost($id);


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

        $lost = Lost::findOrFail($id);

        if ( Gate::denies('edit-losts', $lost) ) {
            return redirect()->route('losts.index')->with('error','您沒有權限編輯');
        }

        $validatedData = $request->validate([
            'title' => 'required|string|max:10',
            'date' => 'date|before:'.date('Y-m-d',strtotime(date('Y-m-d') . '+1 days')).'|after:"2018-01-01"',
            'file_photo' => 'image|mimes:jpeg,png,jpg|max:5000',
            'content' => 'nullable|string|max:100',
        ]);

        /** 如果有上傳檔案 */
        if($request->hasFile('file_photo'))
        {
            $image = Imgur::upload($request->file('file_photo'));
            $request['photo'] = Imgur::size($image->link(), 'l');
        }

        $lost->update($request->except('file_photo'));

        /** 更新快取 */
        Cache::tags('LOST')->flush();

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
    public function index_front(Request $request)
    {

        /**
         * 判斷傳進來的 ?page={num} 是否為數字，若不為數字或為0，則一律顯示第1頁
         */
        $page = ( is_numeric($request->page) && ($request->page > 0) )
            ? $request->page
            : "1";

        $key = "LOST:PAGE:{$page}";

        /**
         * 如果「沒有」這個 key，到資料庫中抓取
         */
        if ( false === Cache::has($key) ) {

            $losts = $this->lostRepository->getLosts();

            /** 如果「有」該頁數的內容，則寫入快取中 (防止亂 try 快取建立很多 key) */
            if ( !!count($losts) ) {
                Cache::tags('LOST')->put($key, $losts, 10);
            }

        }
        else {
            $losts = Cache::get($key);
        }

        $data = compact('losts');
        return view('losts', $data);
    }
}
