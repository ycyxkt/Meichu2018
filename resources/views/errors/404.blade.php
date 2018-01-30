@extends('layouts.layout')

@section('title','找不到頁面')

@section('content')
<script type="text/javascript">
    window.alert('Opps! 找不到頁面。');
    window.history.back();
</script>
@endsection
