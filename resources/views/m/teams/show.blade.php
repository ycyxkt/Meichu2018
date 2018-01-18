@extends('layouts.manage')

@section('title','查看隊伍')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="row">
                <div class="col-xs-6">
                    <a href="{{ route('teams.index') }}" class="btn btn-default" role="button">< 所有隊伍</a>
                </div>
                @if(Auth::user()->school != $team->school && Auth::user()->school != 'other')
                @else
                    <div class="col-xs-6 text-right">
                        <a href="{{ route('teams.edit',$team->id) }}" class="btn btn-warning" role="button">編輯</a>
                    </div>
                @endif
            </div>
                <table class="table table-striped">
                    <tr>
                        <th>隊伍中文名</th>
                        <th>{{ $team->name }}</th>
                    </tr>
                    <tr>
                        <th>隊伍英文名</th>
                        <th>{{ $team->name_en }}</th>
                    </tr>
                    <tr>
                        <th>學校</th>
                        <th>
                            @switch($team->school)
                                @case('NTHU')
                                    國立清華大學
                                    @break
                                @case('NCTU')
                                    國立交通大學
                                    @break
                            @endswitch
                        </th>
                    </tr>
                    <tr>
                        <th>所屬比賽</th>
                        <th>{{ $game->name }}</th>
                    </tr>
                    <tr>
                        <th>隊伍簡介</th>
                        <th>{{ $team->introduction }}</th>
                    </tr>
                    <tr>
                        <th>官網網址</th>
                        <th>{{ $team->link_website }}</th>
                    </tr>
                    <tr>
                        <th>facebook網址</th>
                        <th>{{ $team->link_facebook }}</th>
                    </tr>
                    <tr>
                        <th>instagram網址</th>
                        <th>{{ $team->link_instagram }}</th>
                    </tr>
                    <tr>
                        <th>隊伍Logo</th>
                        <th>
                            @if($team->logo != NULL)
                                <img src="{{ URL::to('/') }}{{ $team->logo }}" width="200px">
                            @else
                                目前無Logo
                            @endif
                        </th>
                    </tr>
                    <tr>
                        <th>隊伍照片</th>
                        <th>
                            @if($team->photo != NULL)
                                <img src="{{ URL::to('/') }}{{ $team->photo }}" width="200px">
                            @else
                                目前無照片
                            @endif
                        </th>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection