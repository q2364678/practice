@extends('layouts.master')
@section('title','404')
@section('nav_index','active')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <h2>404 </h2>
            <h3>錯誤提示:{{$exception->getMessage()}} </h3>
            
        </div>
    </div>
</div>

@endsection