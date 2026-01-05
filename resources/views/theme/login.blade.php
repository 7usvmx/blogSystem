@extends('layouts.themelayout.master')
@section('title', "Login")
@section('hero-title', 'Login')
@section('hero-main-title', 'Login')
@section('hero-sub-title', 'Signin to your account')
@section('content')

@include('layouts.themelayout.partial.hero')


<!-- ================ login section start ================= -->
<section class="section-margin--small section-margin">
  <div class="container">
    <div class="row">
      <div class="col-6 mx-auto">
        <form class="form-contact contact_form" action="{{ route('login') }}" method="post">
          @csrf
          <div class="form-group">
            <input class="form-control border" name="email" type="email" placeholder="Enter email address" value="{{ old('email') }}" />
            @error('email')
            <span class="text-danger">{{ $message }}</span>
            @enderror
          </div>
          <div class="form-group">
            <input class="form-control border" name="password" type="password" placeholder="Enter your password" />
            @error('password')
            <span class="text-danger">{{ $message }}</span>
            @enderror
          </div>
          <div class="form-group text-center text-md-right mt-3">
            <button type="submit" class="button button--active button-contactForm w-100">
              Login
            </button>
            <a href="{{ route('register') }}" class="mt-3 text-dark">Don't have an account?</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>
<!-- ================ login section end ================= -->


@endsection