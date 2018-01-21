@extends('layouts.manage')

@section('title','查看消息')

@section('content')
<div class="row">
    <div class="col-xs-6">
        <a href="{{ route('news.index') }}" class="btn btn-default" role="button">< 所有消息</a>
    </div>
    @if($news->deleted_at==null)
        <div class="col-xs-6 text-right">
            <a href="{{ route('news.edit',$news->id) }}" class="btn btn-primary" role="button">編輯</a>
        </div>
    @endif
</div>
<table class="table table-striped table-hover table-responsive">
    <tr>
        <th>標題</th>
        <th>{{ $news->title }}</th>
    </tr>
    <tr>
        <th>組織{{ $news->author!=NULL ? ' / 作者' : ''}}</th>
        <th>{{ $news->group }}{{ $news->author!=NULL ? ' / '.$news->author : ''}}</th>
    </tr>
    <tr>
        <th>消息新增者</th>
        <th>{{ $news->user()->first()->name }}</th>
    </tr>
    <tr>
        <th>分類</th>
        <th>
            @switch($news->tag)
                @case("news")
                    新聞
                    @break
                @case("ann_activity")
                    活動公告
                    @break
                @case("ann_games")
                    賽事公告
                    @break
                @case("other")
                    其他
                    @break
            @endswitch
        </th>
    </tr>
    @if($news->game!=null)
        <tr>
            <th>所屬比賽</th>
            <th>{{ $news->game()->first()->name }}</th>
        </tr>
    @endif
    <tr>
        <th>內文</th>
        <th>{!! nl2br(e($news->content)) !!}</th>
    </tr>
    <tr>
        <th>網址</th>
        <th><a href="{{ $news->link }}" target="_blank">{{ $news->link }}</a></th>
    </tr>
    <tr>
        <th>建立於</th>
        <th>{{ $news->created_at }}</th>
    </tr>
    <tr>
        <th>最後更新於</th>
        <th>{{ $news->updated_at }}</th>
    </tr>
    @if($news->deleted_at != null)
        <tr>
            <th>刪除於</th>
            <th>{{ $news->deleted_at }}</th>
        </tr>
    @endif
</table>
@endsection