@extends('layouts.manage')

@section('title','查看隊伍')

@section('content')
<div class="row">
    <div class="col-xs-6">
        <a href="{{ route('teams.index') }}" class="btn btn-default" role="button">< 所有隊伍</a>
    </div>
    @if(Auth::user()->school != $team->school && Auth::user()->school != 'other')
    @else
        <div class="col-xs-6 text-right">
            <a href="{{ route('teams.edit',$team->id) }}" class="btn btn-primary" role="button">編輯</a>
        </div>
    @endif
</div>
<table class="table table-striped table-hover table-responsive">
    <tr>
        <th>隊伍中文名</th>
        @switch($team->school)
            @case('NTHU')<th class="color_nthu">國立清華大學@break
            @case('NCTU')<th class="color_nctu">國立交通大學@break
            @default<th class="color_other">@break
        @endswitch{{ $team->name }}</th>
    </tr>
    <tr>
        <th>隊伍英文名</th>
        @if($team->name_en!=NULL)
            @switch($team->school)
                @case('NTHU')<th class="color_nthu">{{ $team->name_en }}, NTHU</th>@break
                @case('NCTU')<th class="color_nctu">{{ $team->name_en }}, NCTU</th>@break
                @default<th class="color_other">{{ $team->name_en }}</th>@break
            @endswitch
        @else
            <th></th>
        @endif
    </tr>
    <tr>
        <th>所屬賽事</th>
        <th>
            <a href="{{ url('games/'.$team->game()->first()->game) }}" target="_blank">
                {{ $team->game()->first()->name }}
            </a>
        </th>
    </tr>
    <tr>
        <th>隊伍簡介</th>
        <th>{!! nl2br(e($team->introduction)) !!}</th>
    </tr>
    <tr>
        <th>官網網址</th>
        <th>
            <a href="{{ $team->link_website }}" target="_blank">
                {{ $team->link_website }}
            </a>
        </th>
    </tr>
    <tr>
        <th>Facebook粉絲頁網址</th>
        <th>
            <a href="{{ $team->link_facebook }}" target="_blank">
                {{ $team->link_facebook }}
            </a>
        </th>
    </tr>
    <tr>
        <th>Instagram帳號網址</th>
        <th>
            <a href="{{ $team->link_instagram }}" target="_blank">
                {{ $team->link_instagram }}
            </a>
        </th>
    </tr>
    <!--<tr>
        <th>隊伍Logo</th>
        <th>
            @if($team->logo != NULL)
                <img src="{{ asset('images/'.$team->logo) }}" width="200px">
            @else
                目前無Logo
            @endif
        </th>
    </tr>-->
    <tr>
        <th>隊伍照片</th>
        <th>
            @if($team->photo != NULL)
                <img src="{{ $team->photo }}" width="400px">
            @else
                目前無照片
            @endif
        </th>
    </tr>
</table>
@endsection