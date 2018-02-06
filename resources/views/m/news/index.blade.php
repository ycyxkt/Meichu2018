@extends('layouts.manage')

@section('title','消息管理')

@section('content')
<div class="row">
    <div class="col-xs-6 col-xs-offset-6 text-right">
        <a href="{{ route('news.create') }}" class="btn btn-info" role="button">新增消息</a>
    </div>
</div>
<table class="table table-striped table-hover table-responsive">
    <thead>
        <th>標題</th>
        <th>消息新增者</th> 
        <th>分類</th>
        <th>最後更新於</th>
        <th></th>
        <th></th>
        <th></th>
    </thead>
    @foreach($news as $data)
    <tr style="@if($data->deleted_at!=NULL) color:#B80; @endif">
        <th>
            @if($data->is_sticky == '1')
                <span class="label label-danger">置頂</span>
            @endif
            {{ $data->title }}</th>
        <th>{{ $data->user()->first()->name }}</th>
        <th>
            @switch($data->tag)
                @case("news")
                    新聞
                    @break
                @case("ann_events")
                    活動公告
                    @break
                @case("ann_games")
                    賽事公告
                    @break
                @case("other")
                    其他
                    @break
                @default
                    {{$data->tag}}
                    @break
            @endswitch
        </th>
        <th>{{ \Carbon\Carbon::parse( $data->updated_at )->format('m/d H:i') }}</th>

        
        <th>
            <a href="{{ route('news.show', $data->id) }}" class="btn btn-success" role="button">查看</a>
        </th>
        @if($data->deleted_at==NULL)
        <th>
            <a href="{{ route('news.edit', $data->id) }}" class="btn btn-primary" role="button">編輯</a>
        </th>
        <th>
            {!! Form::open([
                'method' => 'DELETE',
                'route' => ['news.destroy', $data->id]
            ]) !!}
            {!! Form::submit('刪除', ['class' => 'btn btn-danger']) !!}
            {!! Form::close() !!}
        </th>
        @else
            <th></th>
            <th></th>
        @endif
    </tr>
    @endforeach
</table>
@endsection
