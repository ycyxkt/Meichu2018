@extends('layouts.manage')

@section('title','活動管理')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="row">
                <div class="col-xs-6 col-xs-offset-6 text-right">
                    <a href="{{ route('events.create') }}" class="btn btn-info" role="button">新增活動</a>
                </div>
            </div>
            <table class="table table-striped">
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
                    <th>{{ $data->tag }}</th>
                    <th>{{ $data->title }}</th>
                    <th>{{ \Carbon\Carbon::parse( $data->date )->format('m/d') }} {{ \Carbon\Carbon::parse( $data->time )->format('H:i') }}</th>
                    <th>{{ $data->location }}</th>
                    <th>{{ $data->group }}</th>

                    <th>
                        <a href="{{ route('events.edit', $data->id) }}" class="btn btn-warning" role="button">編輯</a>
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
                        <h2>清大索票規則</h2>
                        <div>{!! nl2br(e($text_nthu)) !!}</div>
                        <a href="{{ route('texts.edit', 1) }}" class="btn btn-warning" role="button">編輯</a>
                    </div>
                @endif
                @if(Auth::user()->school != 'NTHU' )
                    <div class="col-md-6">
                        <h2>交大索票規則</h2>
                        <div>{!! nl2br(e($text_nctu)) !!}</div>
                        <a href="{{ route('texts.edit', 2) }}" class="btn btn-warning" role="button">編輯</a>
                    </div>
                @endif
            @endif
        </div>
    </div>
</div>
@endsection
