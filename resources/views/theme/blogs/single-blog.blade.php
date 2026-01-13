@extends('layouts.themelayout.master')
@section('title', 'Single Blog')
@section('hero-title', $blog->name)
@section('hero-main-title', $blog->name)
@section('hero-sub-title', $blog->name)
@section('content')
@include('layouts.themelayout.partial.hero')


<!--================ Start Blog Post Area =================-->
<section class="blog-post-area section-margin">
  <div class="container">
    <div class="row">



      <div class="col-lg-8">
        <div class="main_blog_details">
          <img class="img-fluid" src="{{ asset('storage/blogs/img/' . $blog->image) }}" alt="">
          <a href="#">
            <h4>{{ $blog->name }}</h4>
          </a>
          <div class="user_details">
            <div class="float-right mt-sm-0 mt-3">
              <div class="media">
                <div class="media-body">
                  <h5>{{ $blog->user->name }}</h5>
                  <p>{{ $blog->created_at->format('d M, Y') }}</p>
                </div>
                <div class="d-flex">
                  <img width="42" height="42" src="{{ asset('storage/blogs/img/' . $blog->image) }}" alt="">
                </div>
              </div>
            </div>
          </div>
          <p>{{ $blog->description }}</p>
        </div>

        <div class="comments-area ">
          @if (count($blog->comments) > 0)
          <h4>{{ count($blog->comments) }} Comments</h4>
          <div class="comment-list">
            @foreach ($blog->comments as $comment)
            <div class="single-comment justify-content-between d-flex">
              <div class="user justify-content-between d-flex">
                <div class="thumb">
                  <img src="{{ asset('theme-assets/img/avatar.png') }}" width="50px">
                </div>
                <div class="desc">
                  <h5><a href="#">{{ optional($comment->user)->name ?? $comment->name }}</a></h5>
                  <p class="date">{{ $comment->created_at->format('d M, Y') }} </p>
                  <p class="comment">
                    {{ $comment->commentBody }}
                  </p>
                </div>
              </div>
            </div>
          </div>
          @endforeach
          @else
          <div class="col-md-12 text-center">
            <div class="single-recent-blog-post card-view">
              <div class="details mt-20">
                <h3>No Comments Yet</h3>
                <center>
                  <script src="https://unpkg.com/@lottiefiles/dotlottie-wc@0.8.11/dist/dotlottie-wc.js" type="module"></script>
                  <dotlottie-wc src="https://lottie.host/480f09d0-274b-4ca6-8a6e-202d55e179ef/QDaFtNwcH7.lottie" style="width: 100px;height: 100px" autoplay loop></dotlottie-wc>
                </center>
              </div>
            </div>
          </div>
          @endif
        </div>

        <div class="comment-form">
          <h4>Leave a Reply</h4>

          @if (session()->has('CommentCreateStatus'))
          <div class="alert alert-success">
            {{ session()->get('CommentCreateStatus') }}
          </div>
          @endif

          @if (session()->has('CommentFailedStatus'))
          <div class="alert alert-danger">
            {{ session()->get('CommentFailedStatus') }}
          </div>
          @endif

          <form method="POST" action="{{ route('comment.store') }}">
            @csrf
            <input type="hidden" name="blog_id" value="{{ $blog->id }}">
            <div class="form-group form-inline">
              @if(!auth()->check())
              <div class="form-group col-lg-6 col-md-6 name">
                <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Enter Name" name="name">
                @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
              <div class="form-group col-lg-6 col-md-6 email">
                <input type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Enter email address" name="email">
                @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
              @endif
            </div>
            <!-- <div class="form-group">
              <input type="text" class="form-control @error('subject') is-invalid @enderror" placeholder="Subject" name="subject">
              @error('subject')
              <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div> -->
            <div class="form-group">
              <textarea class="form-control mb-10 @error('commentBody') is-invalid @enderror" rows="5" placeholder="Comment" name="commentBody"></textarea>
              @error('commentBody')
              <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <input class="button submit_btn" type="submit" value="Post Comment">
          </form>
        </div>
      </div>

      <!-- Start Blog Post Siddebar -->
      @include('layouts.themelayout.partial.sidebar')
      <!-- End Blog Post Siddebar -->
    </div>
</section>
<!--================ End Blog Post Area =================-->


@endsection