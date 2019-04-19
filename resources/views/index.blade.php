@extends('layouts.master')
@section('title','首頁')
@section('nav_index','active')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <h2>首頁 </h2>
            <img src="{{asset('image/pugg.jpg')}}" width="100%">
            <!--都從專案目錄底下的public開始抓-->
            <!--asset路徑不包含public-->
            
        </div>
    </div>
</div>

@endsection