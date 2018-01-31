@extends('layouts.prelayout')

@section('title','首頁')

@section('content')
<section class="intro">
    <div class="intro-background" style="background-image:url({{ asset('images/cover.png') }});"></div>
    <img src="{{ asset('images/fox.png') }}" class="intro-fox">
    <img src="{{ asset('images/panda.png') }}" class="intro-panda">
    <div class="intro-brand">
        <a href="/"><img src="{{ asset('images/brand-logo.png') }}" alt="戊戌梅竹"></a>
    </div>
</section>

<div class="container">
    <div class="infoblock">
        <h2 style="text-align: center;">
            <i class="fa fa-wrench" aria-hidden="true"></i>
            <span>網站建置中</span>
        </h2>
    </div>


    <section>
        <h2 class="sec-header">
            <i class="fa fa-th" aria-hidden="true"></i>
            <span>賽程表</span>
        </h2>
        <div class="gameinfo-layer">
            <div class="gameinfo-flex">
                <div class="game-date">03/02 （五）</div>
                @foreach($games['2018-03-02'] as $data)
                <div class="gameinfo">
                    <div class="game-name">
                        {{ $data->name }}
                    </div>
                    <div class="gameinfo-info">
                        <div class="gameinfo-date">{{ \Carbon\Carbon::parse( $data->date )->format('m/d')}} {{ \Carbon\Carbon::parse( $data->time )->format('H:i')}}</div>
                        <div>{{ $data->location }}</div>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="gameinfo-flex">
                <div class="game-date">03/03 （六）</div>
                
                @foreach($games['2018-03-03'] as $data)
                <div class="gameinfo">
                    <div class="game-name">
                        {{ $data->name }}
                    </div>
                    <div class="gameinfo-info">
                        <div class="gameinfo-date">{{ \Carbon\Carbon::parse( $data->date )->format('m/d')}} {{ \Carbon\Carbon::parse( $data->time )->format('H:i')}}</div>
                        <div>{{ $data->location }}</div>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="gameinfo-flex">
                <div class="game-date">03/04 （日）</div>
                
                @foreach($games['2018-03-04'] as $data)
                <div class="gameinfo">
                    <div class="game-name">
                        {{ $data->name }}
                    </div>
                    <div class="gameinfo-info">
                        <div class="gameinfo-date">{{ \Carbon\Carbon::parse( $data->date )->format('m/d')}} {{ \Carbon\Carbon::parse( $data->time )->format('H:i')}}</div>
                        <div>{{ $data->location }}</div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
</div>
@endsection
