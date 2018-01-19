@extends('layouts.manage')

@section('title','遺失物管理')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="row">
                <div class="col-xs-6 col-xs-offset-6 text-right">
                    <a href="{{ route('losts.create') }}" class="btn btn-info" role="button">新增遺失物</a>
                </div>
            </div>
            <table class="table table-striped">
                <thead>
                    <th>名稱</th>
                    <th>擁有者</th> 
                    <th>分類</th>
                    <th>拾獲日期</th>
                    <th></th>
                    <th></th>
                </thead>
                @foreach($losts as $data)
                <tr style="@if($data->deleted_at!=NULL) color:red; @endif">
                    <th>{{ $data->title }}</th>
                    <th>{{ $data->user()->first()->name }}</th>
                    <th>
                        @if($data->tag == "ticket")
                            發票
                        @elseif($data->tag == "other")
                            其他
                        @endif
                        @foreach($games as $game)
                            @if($data->tag == $game -> game)
                                {{ $game->name }}
                            @endif
                        @endforeach
                    </th>
                    <th>{{ $data->date }}</th>

                    
                    <th>
                        <a href="{{ route('losts.show', $data->id) }}" class="btn btn-success" role="button">查看</a>
                    </th>
                    @if($data->deleted_at==NULL)
                    <th>
                        <a href="{{ route('losts.edit', $data->id) }}" class="btn btn-warning" role="button">編輯</a>
                    </th>
                    <th>
                        {!! Form::open([
                            'method' => 'DELETE',
                            'route' => ['losts.destroy', $data->id]
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
