@extends('layouts.manage')

@section('title','隊伍管理')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="row">
                <div class="col-xs-6 col-xs-offset-6 text-right">
                    <a href="{{ route('teams.create') }}" class="btn btn-info" role="button">新增隊伍</a>
                </div>
            </div>
            <table class="table table-striped">
                <thead>
                    <th>隊伍名稱</th>
                    <th>學校</th> 
                    <th>所屬比賽</th>
                    <th></th>
                    <th></th>
                    <th></th>
                </thead>
                @foreach($teams as $data)
                <tr>
                    <th>{{ $data->name }}</th>
                    <th>
                        @switch($data->school)
                            @case('NCTU')
                                <span style='color:#232323'>國立交通大學</span>
                                @break
                            @case('NTHU')
                                <span style='color:#232323'>國立清華大學</span>
                                @break
                        @endswitch
                    </th> 
                    <th>{{ $data->gamename }}</th>

                    
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
        </div>
    </div>
</div>
@endsection
