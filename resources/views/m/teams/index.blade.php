@extends('layouts.manage')

@section('title','隊伍管理')

@section('content')
<div class="row">
    <div class="col-xs-6 col-xs-offset-6 text-right">
        <a href="{{ route('teams.create') }}" class="btn btn-info" role="button">新增隊伍</a>
    </div>
</div>
<table class="table table-striped table-hover table-responsive">
    <thead>
        <th>隊伍名稱</th>
        <th>所屬賽事</th>
        <th></th>
        <th></th>
        <th></th>
    </thead>
    @foreach($teams as $data)
    <tr>
        @switch($data->school)
            @case('NTHU')<th class="color_nthu">國立清華大學@break
            @case('NCTU')<th class="color_nctu">國立交通大學@break
            @default<th class="color_other">@break
        @endswitch{{ $data->name }}</th>

        <th>{{ $data->game()->first()->name }}</th>

        
        <th>
            <a href="{{ route('teams.show', $data->id) }}" class="btn btn-success" role="button">查看</a>
        </th>
        @if(Auth::user()->school != $data->school && Auth::user()->school != 'other')
            <th></th>
            <th></th>
        @else
            <th>
                <a href="{{ route('teams.edit', $data->id) }}" class="btn btn-warning" role="button">編輯</a>
            </th>
            <th>
                {!! Form::open([
                    'method' => 'DELETE',
                    'route' => ['teams.destroy', $data->id]
                ]) !!}
                {!! Form::submit('刪除', ['class' => 'btn btn-danger']) !!}
                {!! Form::close() !!}
            </th>
        @endif
    </tr>
    @endforeach
</table>
@endsection
