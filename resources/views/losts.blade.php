@extends('layouts.layout')

@section('title','遺失物')

@section('content')
<section class="introboard">
    <div class="introboard-background" style="background-image:url({{ asset('images/cover.png') }});"></div>
    <div class="introboard-title">遺失物</div>
</section>
<div class="container">
    <div class="infoblock">
        以下遺失物照拾獲日期排序，<br/>
        若有您的物品在其中，請點選下方連結聯繫該組織取回，謝謝。<br/>
    </div>
    <div class="flex-layer">
        @if($losts->isEmpty())
            暫無遺失物。
        @endif
        @foreach($losts as $data)
            <div class="card-block card-losts">
                @if($data->photo!=NULL)
                <div class="card-image">
                    <img src="{{ asset('images/'.$data->photo) }}">
                </div>
                @endif
                <div class="card-inner">
                    <div class="card-header">{{ $data->title }}</div>
                    <div class="card-subtitle">
                        <div>
                            <i class="fa fa-calendar" aria-hidden="true"></i>
                            {{ \Carbon\Carbon::parse( $data->date )->format('m/d')}}
                        </div>
                        <div>
                            <i class="fa fa-map-marker" aria-hidden="true"></i>
                            {{ $data->location }}
                        </div>
                        <div>
                            <i class="fa fa-tag" aria-hidden="true"></i>
                            {{ $data->tag }}
                        </div>
                    </div>
                    <div class="card-info">
                        {!! nl2br(e($data->content)) !!}
                    </div>
                </div>
                <div class="card-link">
                    
                    @if($data->group == '梅竹賽籌備委員會')
                        <a href="https://www.facebook.com/%E6%A2%85%E7%AB%B9%E7%B1%8C%E5%82%99%E5%A7%94%E5%93%A1%E6%9C%83-158800937594805/" target="_blank">
                    @elseif($data->group == '清大梅竹工作會')
                        <a href="https://www.facebook.com/meichuwin/" target="_blank">
                    @elseif($data->group == '交大梅竹後援會')
                        <a href="https://www.facebook.com/nctu.meichu/" target="_blank">
                    @else
                        <a>
                    @endif
                        <i class="fa fa-search" aria-hidden="true"></i>
                        {{ $data->group }}
                    </a>
                </div>
            </div>
            
        @endforeach
    </div>
</div>
@endsection
