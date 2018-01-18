@extends('layouts.manage')

@section('title','使用者管理')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <table class="table table-striped">
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
                @foreach($users as $user)
                <tr>
                    <th>{{ $user->email }}</th>
                    <th>{{ $user->name }}</th> 
                    <th>{{ $user->school }}</th>
                    <th>{{ $user->group }}</th>
                    <th>{{ $user->note }}</th>
                    <th>
                        {{ \Carbon\Carbon::parse( $user->updated_at )->format('m/d H:i:s')}} 
                    </th>
                    <th>
                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning" role="button">編輯</a>
                    </th>
                    <th>
                        {!! Form::open([
                            'method' => 'DELETE',
                            'route' => ['users.delete', $user->id]
                        ]) !!}
                        {!! Form::submit('刪除', ['class' => 'btn btn-danger']) !!}
                        {!! Form::close() !!}
                    </th>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>
@endsection
