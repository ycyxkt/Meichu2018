@extends('layouts.manage')

@section('title','編輯資訊')

@section('content')
<div class="panel panel-default">
    <div class="panel-heading">編輯資訊</div>

    <div class="panel-body">
        <form class="form-horizontal" method="POST" action="{{ url('/m/texts/'.$text->id) }}">
            {{ csrf_field() }}
            {{ method_field('PATCH') }}

            <div class="form-group">
                <label for="name" class="col-md-4 control-label">編輯的文字為</label>

                <div class="col-md-6 form-control-static">
                    <input id="name" type="hidden" class="form-control" name="name" value="{{ $text->name }}" readonly required>
                    @switch( $text->name )
                        @case('ticket_nthu')
                            清大索票規則
                            @break
                        @case('ticket_nctu')
                            交大索票規則
                            @break
                    @endswitch
                </div>
        </div>

            <div class="form-group">
                <label for="content" class="col-md-4 control-label">敘述</label>

                <div class="col-md-6">
                    <textarea id="content" class="form-control" name="content" rows="8">
                        {{ $text->content }}
                    </textarea>
                </div>
            </div>


            <div class="form-group">
                <div class="col-md-4 text-right">
                    <a href="{{ route('events.index') }}" class="btn btn-danger" role="button">取消更新</a>
                </div>
                <div class="col-md-6">
                    <button type="submit" class="btn btn-primary">
                        更新資訊
                    </button>
                </div>
            </div>
        </form>
        
    </div>
</div>
@endsection