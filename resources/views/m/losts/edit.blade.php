@extends('layouts.manage')

@section('title','編輯遺失物')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="row">
                <div class="col-xs-6">
                    <a href="{{ route('losts.index') }}" class="btn btn-default" role="button">< 所有遺失物</a>
                </div>
                <div class="col-xs-6 text-right">
                     <a href="{{ route('losts.show',$lost->id) }}" class="btn btn-success" role="button">查看</a>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">編輯遺失物</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ url('/m/losts/'.$lost->id) }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{ method_field('PATCH') }}

                        <div class="form-group">
                            <label for="title" class="col-md-4 control-label">名稱</label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control" name="title" value="{{ $lost->title }}" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="group" class="col-md-4 control-label">組織</label>

                            <div class="col-md-6">
                                @switch(Auth::user()->group)
                                    @case('committee')
                                        <input id="group" type="text" class="form-control" name="group" value="梅竹賽籌備委員會" readonly required>
                                        @break
                                    @case('cheer')
                                        @if(Auth::user()->school == 'NCTU')
                                            <input id="group" type="text" class="form-control" name="group" value="交大梅竹後援會" readonly required>
                                        @elseif(Auth::user()->school == 'NTHU')
                                            <input id="group" type="text" class="form-control" name="group" value="清大梅竹工作會" readonly required>
                                        @endif
                                        @break
                                    @case('media')
                                        @if(Auth::user()->school == 'NCTU')
                                            <input id="group" type="text" class="form-control" name="group" value="交大喀報" readonly required>
                                        @elseif(Auth::user()->school == 'NTHU')
                                            <input id="group" type="text" class="form-control" name="group" value="清華電台" readonly required>
                                        @endif
                                        @break
                                    @case('admin')
                                        <input id="group" type="text" class="form-control" name="group" value="{{ $lost->group }}" required>
                                        @break
                                @endswitch
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="tag" class="col-md-4 control-label">分類</label>

                            <div class="col-md-6">
                                <select id="tag" class="form-control" name="tag" required>
                                    <option value=""></option>
                                    <option value="ticket" @if($lost->tag == 'ticket') selected @endif>發票</option>
                                    @foreach($games as $data)    
                                    <option value="{{ $data->game }}" @if($lost->tag == $data->game) selected @endif>{{ $data->name }}</option>
                                    @endforeach
                                    <option value="other" @if($lost->tag == 'other') selected @endif>其他</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('date') ? ' has-error' : '' }}">
                            <label for="date" class="col-md-4 control-label">拾獲日期</label>

                            <div class="col-md-6">
                                <input id="date" type="date" class="form-control" name="date" value="{{ $lost->date }}" required>
                                @if ($errors->has('date'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('date') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="location" class="col-md-4 control-label">拾獲地點</label>

                            <div class="col-md-6">
                                <input id="location" type="text" class="form-control" name="location" value="{{ $lost->location }}" required>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
                            <label for="content" class="col-md-4 control-label">描述</label>

                            <div class="col-md-6">
                                <textarea id="content" class="form-control" name="content">{{ $lost->content }}</textarea>
                                @if ($errors->has('content'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('content') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">目前照片</label>

                            <div class="col-md-6">
                                @if($lost->photo != NULL)
                                    <img src="{{ URL::to('/') }}{{ $lost->photo }}" width="400px">
                                @else
                                    目前無照片
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('file_photo') ? ' has-error' : '' }}">
                            <label for="file_photo" class="col-md-4 control-label">更換照片</label>

                            <div class="col-md-6">
                                <input id="file_photo" type="file" class="form-control" name="file_photo">
                                @if ($errors->has('file_photo'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('file_photo') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    編輯遺失物
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection