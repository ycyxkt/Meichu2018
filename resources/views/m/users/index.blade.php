@extends('layouts.manage')

@section('title','使用者管理')

@section('content')
<div class="row">
    <div class="col-xs-6 col-xs-offset-6 text-right">
        <a href="{{ url('m/register') }}" class="btn btn-info" role="button">建立帳號</a>
    </div>
</div>
<table class="table table-striped table-hover table-responsive">
    <thead>
        <th>帳號名</th>
        <th>姓名</th> 
        <th>學校</th>
        <th>身分</th>
        <th>備註</th>
        <th>最後修改於</th>
        <th></th>
        <th></th>
    </thead>
    @foreach($users as $data)
    <tr>
        <th>{{ $data->email }}</th>
        <th>{{ $data->name }}</th> 
        
        @switch($data->school)
            @case('NTHU')
                <th class="color_nthu">清大</th>
                @break
            @case('NCTU')
                <th class="color_nctu">交大</th>
                @break
            @case('other')
                <th class="color_other">其他</th>
                @break
            @default
                <th class="color_other">{{ $data->school }}</th>
                @break
        @endswitch

        <th>
            @switch($data->group)
                @case('admin') 管理員 @break
                @case('committee') 梅竹籌委會 @break
                @case('cheer') 後援組織 @break
                @case('media') 媒體 @break
                @default {{ $data->group }} @break
            @endswitch
        </th>
        <th>{{ $data->note }}</th>

        <th>
            {{ \Carbon\Carbon::parse( $data->updated_at )->format('m/d H:i')}} 
        </th>
        <th>
            <a href="{{ route('users.edit', $data->id) }}" class="btn btn-primary" role="button">編輯</a>
        </th>
        <th>
            {!! Form::open([
                'method' => 'DELETE',
                'route' => ['users.destory', $data->id]
            ]) !!}
            {!! Form::submit('刪除', ['class' => 'btn btn-danger']) !!}
            {!! Form::close() !!}
        </th>
    </tr>
    @endforeach
</table>
@endsection
