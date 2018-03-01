<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\News;
use App\Repositories\NewsRepository;

use Auth;
use Gate;
use Cache;

class NewsController extends Controller
{

    /**
     * Construct
     */
    public function __construct()
    {
        $this->newsRepository = new NewsRepository(new News);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->group == 'committee'){
            $query = \App\News::join('users', 'users.id', '=', 'news.user_id')
                    ->where('users.group', '=', 'committee')
                    ->select('news.*');
        }
        elseif(Auth::user()->group == 'admin'){
            $query = \App\News::withTrashed();
        }
        else {
            $query = \App\News::where('user_id', '=', Auth::user()->id);
        }
        $news = $query->orderBy('is_sticky','desc')->orderBy('id','desc')
                ->get();
        $data = compact('news');
        return view('m.news.index', $data);
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
        return view('m.news.create', $data);
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
            'title' => 'required||string|max:80',
            'link' => 'nullable|url',
            'content' => 'nullable|string|max:600',
        ]);
        $request['user_id']=Auth::user()->id;
        \App\News::create($request->all());

        /** 更新快取 */
        Cache::tags("NEWS")->flush();

        return redirect()->route('news.index')->with('success','建立消息成功');
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
            $news = \App\News::withTrashed()
                    ->find($id);
        }
        else{
            $news = \App\News::find($id);
        }
        if (Gate::denies('edit-news', $news)) {
            return redirect()->route('news.index')->with('error','您沒有權限查看');
        }
        $data = compact('news');

        return view('m.news.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $news = \App\News::find($id);
        if (Gate::denies('edit-news', $news)) {
            return redirect()->route('news.index')->with('error','您沒有權限編輯');
        }
        $games = \App\Game::orderBy('date','asc')
                ->orderBy('time','asc')
                ->select('name','game')
                ->get();
        $data = compact('news','games');

        return view('m.news.edit', $data);
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
        $news = \App\News::findOrFail($id);
        if (Gate::denies('edit-news', $news)) {
            return redirect()->route('news.index')->with('error','您沒有權限編輯');
        }
        $validatedData = $request->validate([
            'title' => 'required||string|max:80',
            'link' => 'nullable|url',
            'content' => 'nullable|string|max:600',
        ]);
        $news->update($request->all());

        /** 更新快取 */
        Cache::tags("NEWS")->flush();

        return redirect()->route('news.show',$id)->with('success','更新消息成功');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $news = \App\News::findOrFail($id);
        if (Gate::allows('edit-news', $news)) {
            $news->delete();
            return redirect()->route('news.index')->with('success','刪除消息成功');
        }
        return redirect()->route('news.index')->with('error','您沒有權限刪除');
    }

    /**
     * 前端的新聞列表
     *
     * @return void
     */
    public function index_front(Request $request)
    {

        /**
         * 判斷傳進來的 ?page={num} 是否為數字，若不為數字或為0，則一律顯示第1頁
         */
        $page = ( is_numeric($request->page) && ($request->page > 0) )
            ? $request->page
            : "1";

        $key = "NEWS:PAGE:{$page}";

        /**
         * 如果「沒有」這個 key，到資料庫中抓取
         */
        if ( false === Cache::has($key) ) {

            $news = $this->newsRepository->getNews();

            /** 如果「有」該頁數的內容，則寫入快取中 (防止亂 try 快取建立很多 key) */
            if ( !!count($news) ) {
                Cache::tags('NEWS')->put($key, $news, 10);
            }

        }
        else {
            $news = Cache::get($key);
        }

        return view('news.index', compact('news'));

    }

    /**
     * 前端的顯示新聞列表
     *
     * @param int $id
     * @return view
     */
    public function show_front($id){

        $news = Cache::tags("NEWS")->remember("NEWS:VIEW:{$id}", 5, function() use ($id) {
            return [
                'news' => $this->newsRepository->getNewsById($id),
                'previous' => $this->newsRepository->getPrevious($id),
                'next' => $this->newsRepository->getNext($id)
            ];
        });

        $data = compact('news');
        return view('news.show', $data);
    }
}
