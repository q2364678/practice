

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">{{env('APP_NAME')}}</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item @yield('nav_index')">
        <a class="nav-link" href="{{route('index')}}">首頁<span class="sr-only">(current)</span></a>
      </li>
      
      

      <li class="nav-item @yield('nav_posts')">
        <a class="nav-link" href="{{route('posts.index')}}">公告系統</a>
      </li>

      <li class="nav-item @yield('nav_inside')">
        <a class="nav-link" href="{{route('inside')}}">處內文件</a>
      </li>

      

      @guest
      <li class="nav-item @yield('nav_login')">
        <a class="nav-link disabled" href="{{route('login')}}" tabindex="-1" aria-disabled="true">登入</a>

      <li class="nav-item @yield('nav_register')">
        <a class="nav-link disabled" href="{{route('register')}}" tabindex="-1" aria-disabled="true">註冊</a>
      </li>
      @endguest

      @auth
      <li class="nav-item @yield('nav_register')">
        <a class="nav-link disabled" href="{{route('logout')}}" tabindex="-1" aria-disabled="true">登出</a>
      </li>
      @endauth

      </li>
    </ul>
  </div>
</nav>

