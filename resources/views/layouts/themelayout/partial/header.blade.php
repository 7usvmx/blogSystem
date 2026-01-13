@php
$categories = \App\Models\Category::all();
@endphp
<!--================Header Menu Area =================-->
<header class="header_area">
  <div class="main_menu">
    <nav class="navbar navbar-expand-lg navbar-light">
      <div class="container box_1620">
        <!-- Brand and toggle get grouped for better mobile display -->
        <a class="navbar-brand logo_h" href="/"><img src="{{asset('theme-assets/img/logo.png')}}" alt=""></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
          <ul class="nav navbar-nav menu_nav justify-content-center">
            <li class="nav-item active"><a class="nav-link" href="{{route('theme.index')}}">Home</a></li>
            <li class="nav-item submenu dropdown">
              <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                aria-expanded="false">Categories</a>
              <ul class="dropdown-menu">
                @foreach ($categories as $category)
                <li class="nav-item"><a class="nav-link" href="{{route('theme.categories', $category->slug)}}">{{ $category->name }}</a></li>
                @endforeach
              </ul>
            </li>
            <li class="nav-item"><a class="nav-link" href="{{route('theme.contact')}}">Contact</a></li>
          </ul>

          <!-- Add new blog -->
          <!-- <a href="#" class="btn btn-sm btn-primary mr-2">Add New</a> -->
          <!-- End - Add new blog -->

          <ul class="nav navbar-nav navbar-right navbar-social">
            @guest
            <a href="{{route('login')}}" class="btn btn-sm btn-warning">Register / Login</a>
            @endguest
            @auth
            <ul class="nav navbar-nav navbar-right navbar-social">
              <li class="nav-item submenu dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                  <i class="fa fa-user"></i> {{ Auth::user()->name }}
                </a>
                <ul class="dropdown-menu">
                  <li class="nav-item"><a class="nav-link" href="{{ route('blog.index') }}">My Blogs</a></li>
                  <li class="nav-item"><a class="nav-link" href="blog-details">My Profile</a></li>
                  <form action="{{route('logout')}}" method="post">
                    @csrf
                    <li class="nav-item">
                      <a class="nav-link" onclick="event.preventDefault(); this.closest('form').submit();" style="cursor: pointer;">Logout</a>
                    </li>
                  </form>
                </ul>
              </li>
            </ul>
            @endauth
          </ul>
        </div>
      </div>
    </nav>
  </div>
</header>
<!--================Header Menu Area =================-->