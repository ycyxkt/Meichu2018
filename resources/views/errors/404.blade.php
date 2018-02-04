@extends('layouts.layout')

@section('title','找不到頁面')

@section('content')

<section class="introboard">
    <div class="introboard-background" style="background-image:url({{ asset('images/cover.png') }});"></div>
    <div class="introboard-title">oops</div>
</section>

<div class="container">
    <div class="infoblock">
        找不到這個網頁<br/>
        The page you requested was not found.
    </div>

</div>

@endsection
