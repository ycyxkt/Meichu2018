@extends('layouts.manage')

@section('title','查看遺失物')

@section('content')
<div class="row">
    <div class="col-xs-6">
        <a href="{{ route('losts.index') }}" class="btn btn-default" role="button">< 所有遺失物</a>
    </div>
    @if($lost->deleted_at==null)
        <div class="col-xs-6 text-right">
            <a href="{{ route('losts.edit',$lost->id) }}" class="btn btn-primary" role="button">編輯</a>
        </div>
    @endif
</div>
<table class="table table-striped table-hover table-responsive">
    <tr>
        <th>名稱</th>
        <th>{{ $lost->title }}</th>
    </tr>
    <tr>
        <th>新增者</th>
        <th>{{ $lost->user()->first()->name }}</th>
    </tr>
    <tr>
        <th>拾獲組織</th>
        <th>{{ $lost -> group }}</th>
    </tr>
    <tr>
        <th>拾獲日期</th>
        <th>{{ \Carbon\Carbon::parse( $lost->date )->format('Y/m/d') }}</th>
    </tr>
    <tr>
        <th>拾獲地點</th>
        <th>{{ $lost -> location }}</th>
    </tr>
    <tr>
        <th>分類</th>
        <th>{{ $lost->tag }}</th>
    </tr>
    <tr>
        <th>描述</th>
        <th>{!! nl2br(e($lost->content)) !!}</th>
    </tr>
    <tr>
        <th>物品照片</th>
        <th>
            @if($lost->photo != NULL)
                <img src="{{ asset('images/'.$lost->photo) }}" width="400px">
            @else
                目前無照片
            @endif
        </th>
    </tr>
    <tr>
        <th>建立於</th>
        <th>{{ $lost->created_at }}</th>
    </tr>
    <tr>
        <th>最後更新於</th>
        <th>{{ $lost->updated_at }}</th>
    </tr>
    @if($lost->deleted_at != null)
        <tr>
            <th>刪除於</th>
            <th>{{ $lost->deleted_at }}</th>
        </tr>
    @endif
</table>
@endsection