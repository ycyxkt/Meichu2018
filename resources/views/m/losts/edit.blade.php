@extends('layouts.manage')

@section('title','編輯遺失物')

@section('content')
<div class="row">
    <div class="col-xs-6">
        <a href="{{ route('losts.index') }}" class="btn btn-default" role="button">< 所有遺失物</a>
    </div>
    <div class="col-xs-6 text-right">
            <a href="{{ route('losts.show',$lost->id) }}" class="btn btn-success" role="button">查看</a>
    </div>
</div>
<div class="panel panel-primary">
    <div class="panel-heading">編輯遺失物</div>

    <div class="panel-body">
        <form class="form-horizontal" method="POST" action="{{ url('/m/losts/'.$lost->id) }}" enctype="multipart/form-data">
            {{ csrf_field() }}
            {{ method_field('PATCH') }}

            <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                <label for="title" class="col-md-4 control-label">
                    <span class="label label-primary">必填</span>
                    <span class="label label-default">10字內</span>
                    名稱
                </label>

                <div class="col-md-6">
                    <input id="title" type="text" class="form-control" name="title" value="{{ $lost->title }}" required>
                    @if ($errors->has('title'))
                        <span class="help-block">
                            <strong>{{ $errors->first('title') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <label for="group" class="col-md-4 control-label">
                    <span class="label label-primary">必填</span>
                    組織
                </label>

                <div class="col-md-6">
                    <input id="group" type="text" class="form-control" name="group" value="{{ $lost->group }}" required>
                </div>
            </div>

            <div class="form-group">
                <label for="tag" class="col-md-4 control-label">
                    <span class="label label-primary">必填</span>
                    分類
                </label>

                <div class="col-md-6">
                    <select id="tag" class="form-control" name="tag" required>
                        <option value=""></option>
                        <option value="清大索票活動" @if($lost->tag == '清大索票活動') selected @endif>清大索票活動</option>
                        <option value="交大索票活動" @if($lost->tag == '交大索票活動') selected @endif>交大索票活動</option>
                        <option value="清大賽前活動" @if($lost->tag == '清大賽前活動') selected @endif>清大賽前活動</option>
                        <option value="交大賽前活動" @if($lost->tag == '交大賽前活動') selected @endif>交大賽前活動</option>
                        <option value="兩校賽前活動" @if($lost->tag == '兩校賽前活動') selected @endif>兩校賽前活動</option>
                        @foreach($games as $data)    
                            <option value="{{ $data->name }}" @if($lost->tag == $data->name) selected @endif>{{ $data->name }}</option>
                        @endforeach
                        <option value="其他" @if($lost->tag == '其他') selected @endif>其他</option>
                    </select>
                </div>
            </div>

            <div class="form-group{{ $errors->has('date') ? ' has-error' : '' }}">
                <label for="date" class="col-md-4 control-label">
                    <span class="label label-primary">必填</span>
                    <span class="label label-default">1/1 - 今天</span>
                    拾獲日期
                </label>

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
                <label for="location" class="col-md-4 control-label">
                    <span class="label label-primary">必填</span>
                    拾獲地點
                </label>

                <div class="col-md-6">
                    <input id="location" type="text" class="form-control" name="location" value="{{ $lost->location }}" required>
                </div>
            </div>

            <div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
                <label for="content" class="col-md-4 control-label">
                    <span class="label label-default">100字內</span>
                    描述
                </label>

                <div class="col-md-6">
                    <textarea id="content" class="form-control" name="content" rows="4">{{ $lost->content }}</textarea>
                    @if ($errors->has('content'))
                        <span class="help-block">
                            <strong>{{ $errors->first('content') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-4 control-label">
                    目前物品照片
                </label>

                <div class="col-md-6 form-control-static">
                    @if($lost->photo != NULL)
                        <img src="{{ asset('images/'.$lost->photo) }}" width="400px">
                    @else
                        目前無照片
                    @endif
                </div>
            </div>
            <div class="form-group{{ $errors->has('file_photo') ? ' has-error' : '' }}">
                <label for="file_photo" class="col-md-4 control-label">
                    <span class="label label-default">圖像格式</span>
                    <span class="label label-default">不大於5MB</span>
                    更換物品照片
                </label>

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
                        更新資訊
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection