@extends('layouts.manage')

@section('title','遺失物管理')

@section('content')
<div class="row">
    <div class="col-xs-6 col-xs-offset-6 text-right">
        <a href="{{ route('losts.create') }}" class="btn btn-info" role="button">新增遺失物</a>
    </div>
</div>
<table class="table table-striped table-hover table-responsive">
    <thead>
        <th>名稱</th>
        <th>新增者</th> 
        <th>分類</th>
        <th>拾獲日期</th>
        <th></th>
        <th></th>
        <th></th>
    </thead>
    @foreach($losts as $data)
    <tr style="@if($data->deleted_at!=NULL) color:#B80; @endif">
        <th>{{ $data->title }}</th>
        <th>{{ $data->user()->first()->name }}</th>
        <th>{{ $data->tag }}</th>
        <th>{{ \Carbon\Carbon::parse( $data->date )->format('m/d') }}</th>

        
        <th>
            <a href="{{ route('losts.show', $data->id) }}" class="btn btn-success" role="button">查看</a>
        </th>
        @if($data->deleted_at==NULL)
        <th>
            <a href="{{ route('losts.edit', $data->id) }}" class="btn btn-primary" role="button">編輯</a>
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
@endsection
