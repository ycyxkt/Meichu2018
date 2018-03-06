@extends('layouts.layout')

@section('title','遺失物')

@section('content')
<section class="introboard">
    <div class="introboard-background" style="background-image:url({{ asset('images/cover.png') }});"></div>
    <div class="introboard-title">遺失物</div>
</section>

<section style="text-align: center; font-size: 1.2rem; font-weight: bold;">
    恭喜國立清華大學拿下戊戌梅竹總錦標，若您對戊戌梅竹有任何建議，歡迎填寫<a href="https://www.surveycake.com/s/YOOOK" targer="_BLANK">賽後問卷</a>，謝謝！
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
                    <img src="{{ $data->photo }}">
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
                        <a href="https://www.facebook.com/MeiChuGamePreparatoryCommittee/" target="_blank">
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

    @if($losts->nextPageUrl()!=NULL || $losts->previousPageUrl()!=NULL)
    <div class="pagination-nav infoblock">
        <div class="pagination-nav-prev">
            @if($losts->previousPageUrl()!=NULL)
            <a href="{{ $losts->previousPageUrl() }}">
                <i class="fa fa-chevron-left" aria-hidden="true"></i>
                上一頁
            </a>
            @endif
        </div>

        <div class="pagination-nav-index"></div>
        
        <div class="pagination-nav-next">
            @if($losts->nextPageUrl()!=NULL)
            <a href="{{ $losts->nextPageUrl() }}">
                下一頁
                <i class="fa fa-chevron-right" aria-hidden="true"></i>
            </a>
            @endif
        </div>
    
    </div>
    @endif

</div>
@endsection
