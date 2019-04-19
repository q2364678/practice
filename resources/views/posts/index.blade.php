@extends('layouts.master')
@section('title','公告系統')
@section('nav_posts','active')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <h2>公告系統 </h2>
            @can('create',App\Post::class)
            <a href="{{route('posts.create')}}" class="btn btn-success btn-sm">新增公告</a>
            @endcan

            <!--@auth 確認是否為管理者
            @if(auth()->user()->admin==1)
            <a href="{{route('posts.create')}}" class="btn btn-success btn-sm">新增公告</a>
            @endif
            @endauth
            -->
        </div>
      <div class="col-12">
        <table class="table table-hover">
          <thead>
            <tr>
              <th>
                發表時間
              </th>

              <th>
                標題
              </th>

              <th>
                發表人
              </th>

              <th>
                點閱數
              </th>
            </tr>
          </thead>
          <tbody>
          @foreach($posts as $post)
          <tr>
            <td>
              {{$post->created_at}}              
            </td>

            <td>
             <a href="{{route('posts.show',$post->id)}}"> {{ $post->title }}</a>
            </td>

            <td>
            {{ $post->user->name }}
            ({{$post->user->username}})
            </td>

            <td>
            {{ $post->views }}  
            </td>


          </tr>
          @endforeach
          </tbody>
        </table>
        {{$posts->links()}}
      </div>

    </div>
</div>

@endsection