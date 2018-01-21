@extends('layouts.manage')

@section('title','活動管理')

@section('content')
<div class="row">
    <div class="col-xs-6 col-xs-offset-6 text-right">
        <a href="{{ route('events.create') }}" class="btn btn-info" role="button">新增活動</a>
    </div>
</div>
<table class="table table-striped table-hover table-responsive">
    <thead>
        <th>分類</th>
        <th>名稱</th>
        <th>時間</th> 
        <th>地點</th>
        <th>組織</th>
        <th></th>
        <th></th>
    </thead>
    @foreach($events as $data)
    <tr>
        @switch($data->tag)
            @case('清大索票活動')<th class="color_nthu">@break
            @case('交大索票活動')<th class="color_nctu">@break
            @case('清大賽前活動')<th class="color_nthu">@break
            @case('交大賽前活動')<th class="color_nctu">@break
            @default<th class="color_other">@break
        @endswitch{{ $data->tag }}</th>
        
        <th>{{ $data->title }}</th>
        <th>{{ \Carbon\Carbon::parse( $data->date )->format('m/d') }} {{ \Carbon\Carbon::parse( $data->time )->format('H:i') }}</th>
        <th>{{ $data->location }}</th>
        <th>{{ $data->group }}</th>

        <th>
            <a href="{{ route('events.edit', $data->id) }}" class="btn btn-primary" role="button">編輯</a>
        </th>
        <th>
            {!! Form::open([
                'method' => 'DELETE',
                'route' => ['events.destroy', $data->id]
            ]) !!}
            {!! Form::submit('刪除', ['class' => 'btn btn-danger']) !!}
            {!! Form::close() !!}
        </th>
    </tr>
    @endforeach
</table>

@if(Auth::user()->group == 'committee' || Auth::user()->group == 'admin' )
    @if(Auth::user()->school != 'NCTU' )
        <div class="col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">清大索票規則</div>

                <div class="panel-body">
                    <div>{!! nl2br(e($text_nthu)) !!}</div>
                    <a href="{{ route('texts.edit', 1) }}" class="btn btn-primary" role="button">
                        編輯
                    </a>
                </div>
            </div>
        </div>
    @endif
    @if(Auth::user()->school != 'NTHU' )
        <div class="col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">交大索票規則</div>

                <div class="panel-body">
                    <div>{!! nl2br(e($text_nctu)) !!}</div>
                    <a href="{{ route('texts.edit', 2) }}" class="btn btn-primary" role="button">
                        編輯
                    </a>
                </div>
            </div>
        </div>
    @endif
@endif
@endsection
