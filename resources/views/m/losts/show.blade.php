@extends('layouts.manage')

@section('title','查看遺失物')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="row">
                <div class="col-xs-6">
                    <a href="{{ route('losts.index') }}" class="btn btn-default" role="button">< 所有遺失物</a>
                </div>
                @if($lost->deleted_at==null)
                    <div class="col-xs-6 text-right">
                        <a href="{{ route('losts.edit',$lost->id) }}" class="btn btn-warning" role="button">編輯</a>
                    </div>
                @endif
            </div>
                <table class="table table-striped">
                    <tr>
                        <th>名稱</th>
                        <th>{{ $lost->title }}</th>
                    </tr>
                    <tr>
                        <th>擁有者</th>
                        <th>{{ $lost->user()->first()->name }}</th>
                    </tr>
                    <tr>
                        <th>拾獲組織</th>
                        <th>{{ $lost -> group }}</th>
                    </tr>
                    <tr>
                        <th>拾獲日期</th>
                        <th>{{ $lost -> date }}</th>
                    </tr>
                    <tr>
                        <th>拾獲地點</th>
                        <th>{{ $lost -> location }}</th>
                    </tr>
                    <tr>
                        <th>分類</th>
                        <th>
                            @if($lost->tag == "ticket")
                                發票
                            @elseif($lost->tag == "other")
                                其他
                            @endif
                            @foreach($games as $game)
                                @if($lost->tag == $game -> game)
                                    {{ $game->name }}
                                @endif
                            @endforeach
                        </th>
                    </tr>
                    <tr>
                        <th>描述</th>
                        <th>{{ $lost->content }}</th>
                    </tr>
                    <tr>
                        <th>照片</th>
                        <th>
                            @if($lost->photo != NULL)
                                <img src="{{ URL::to('/') }}{{ $lost->photo }}" width="400px">
                            @else
                                目前無照片
                            @endif
                        </th>
                    </tr>
                    <tr>
                        <th>建立於</th>
                        <th>{{ $lost->created_at }}</th>
                    </tr>
                    <tr>
                        <th>最後更新於</th>
                        <th>{{ $lost->updated_at }}</th>
                    </tr>
                    @if($lost->deleted_at != null)
                        <tr>
                            <th>刪除於</th>
                            <th>{{ $lost->deleted_at }}</th>
                        </tr>
                    @endif
                </table>
            </div>
        </div>
    </div>
</div>
@endsection