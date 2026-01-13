@extends('layouts.themelayout.master')
@section('title', 'Categories')
@section('content')

@section('hero-title', $category)
@section('hero-main-title', 'Categories')
@section('hero-sub-title', 'Categories')

@include('layouts.themelayout.partial.hero')


<!--================ Start Blog Post Area =================-->
<section class="blog-post-area section-margin">
  <div class="container">
    <div class="row">
      <div class="col-lg-8">

        <div class="row">
          @if (count($blogs) > 0)
          @foreach ($blogs as $blog)
          <div class="col-md-6">
            <div class="single-recent-blog-post card-view">
              <div class="thumb">
                <img class="card-img rounded-0" src="{{asset('storage/blogs/img/' . $blog->image)}}" alt="">
                <ul class="thumb-info">
                  <li><a href="#"><i class="ti-user"></i>{{ $blog->user->name }}</a></li>
                  <li><a href="#"><i class="ti-themify-favicon"></i>2 Comments</a></li>
                </ul>
              </div>
              <div class="details mt-20">
                <a href="{{ route('blog.show', $blog) }}">
                  <h3>{{ $blog->title }}</h3>
                </a>
                <p>{{ $blog->description }}</p>
                <a class="button" href="{{ route('blog.show', $blog) }}">Read More <i class="ti-arrow-right"></i></a>
              </div>
            </div>
          </div>
          @endforeach
          @else
          <div class="col-md-12 text-center">
            <div class="single-recent-blog-post card-view">
              <div class="details mt-20">
                <h1>No blogs found</h1>
                <center>
                  <script src="https://unpkg.com/@lottiefiles/dotlottie-wc@0.8.11/dist/dotlottie-wc.js" type="module"></script>
                  <dotlottie-wc src="https://lottie.host/480f09d0-274b-4ca6-8a6e-202d55e179ef/QDaFtNwcH7.lottie" style="width: 300px;height: 300px" autoplay loop></dotlottie-wc>
                </center>
              </div>
            </div>
          </div>
          @endif
        </div>

        <div class="row">
          <div class="col-lg-12">
            <nav class="blog-pagination justify-content-center d-flex">
              {{ $blogs->render('pagination::bootstrap-5') }}
            </nav>
          </div>
        </div>
      </div>

      <!-- Start Blog Post Siddebar -->
      @include('layouts/themelayout/partial/sidebar')
      <!-- End Blog Post Siddebar -->
    </div>
</section>
<!--================ End Blog Post Area =================-->


@endsection