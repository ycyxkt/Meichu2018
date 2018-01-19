@extends('layouts.manage')

@section('title','消息管理')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="row">
                <div class="col-xs-6 col-xs-offset-6 text-right">
                    <a href="{{ route('news.create') }}" class="btn btn-info" role="button">新增消息</a>
                </div>
            </div>
            <table class="table table-striped">
                <thead>
                    <th>標題</th>
                    <th>擁有者</th> 
                    <th>分類</th>
                    <th>最後更新於</th>
                    <th></th>
                    <th></th>
                    <th></th>
                </thead>
                @foreach($news as $data)
                <tr style="@if($data->deleted_at!=NULL) color:red; @endif">
                    <th>{{ $data->title }}</th>
                    <th>{{ $data->user()->first()->name }}</th>
                    <th>
                        @switch($data->tag)
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
                    <th>{{ $data->updated_at }}</th>

                    
                    <th>
                        <a href="{{ route('news.show', $data->id) }}" class="btn btn-success" role="button">查看</a>
                    </th>
                    @if($data->deleted_at==NULL)
                    <th>
                        <a href="{{ route('news.edit', $data->id) }}" class="btn btn-warning" role="button">編輯</a>
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
        </div>
    </div>
</div>
@endsection
