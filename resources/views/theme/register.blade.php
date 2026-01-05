@extends('layouts.themelayout.master')
@section('title', "Register")
@section('hero-title', 'Register')
@section('hero-main-title', 'Register')
@section('hero-sub-title', 'Signin to your account')
@section('content')
@include('layouts.themelayout.partial.hero')
<!-- ================ register section start ================= -->
<section class="section-margin--small section-margin">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <form action="{{ route('register') }}" class="form-contact contact_form" method="post">
          @csrf
          <div class="row">
            <div class="col-6">
              <div class="form-group">
                <input class="form-control border" name="name" type="text" placeholder="Enter your name" value="{{ old('name') }}" />
                @error('name')
                <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
              <div class="form-group">
                <input class="form-control border" name="email" type="email" placeholder="Enter email address" value="{{ old('email') }}" />
                @error('email')
                <span class="text-danger">{{ $message }}</span>
                @enderror
                @error('password')
                <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
            </div>
            <div class="col-6">
              <div class="form-group">
                <input class="form-control border" name="password" type="password" placeholder="Enter your password" />
                @error('password')
                <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
              <div class="form-group">
                <input class="form-control border" name="password_confirmation" type="password" placeholder="Enter your password confirmation" />
                @error('password_confirmation')
                <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
            </div>
          </div>
          <div class="form-group text-center text-md-right mt-3">
            <button type="submit" class="button button--active button-contactForm">Register</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>
<!-- ================ register section end ================= -->

@endsection