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
@endsection
