@extends('layouts.themelayout.master')
@section('title', 'Edit Blog ' . $blog->name)
@section('hero-title', $blog->name)
@section('hero-main-title', 'Edit Blog')
@section('hero-sub-title', $blog->name)
@section('content')
@include('layouts.themelayout.partial.hero')

<section class="py-5 min-vh-100 d-flex align-items-center">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-xl-7 col-lg-8 col-md-10">

        <div class="card border-0 shadow-lg rounded-4 overflow-hidden">

          <!-- Header -->
          <div class="bg-primary text-white text-center p-4">
            <h4 class="fw-bold mb-1">Edit Blog</h4>
            <p class="mb-0 small opacity-75">
              Edit a new article to your website
            </p>
          </div>

          <!-- Body -->
          <div class="card-body p-4 p-md-5">

            @if (session()->has('success'))
            <div class="alert alert-success">
              {{ session()->get('success') }}
            </div>
            @endif

            @if (session()->has('error'))
            <div class="alert alert-danger">
              {{ session()->get('error') }}
            </div>
            @endif

            <form action="{{ route('blog.update', $blog) }}" method="POST" enctype="multipart/form-data">
              @csrf
              @method('PUT')
              <!-- Blog Title -->
              <div class="mb-4">
                <label class="form-label fw-semibold">
                  Blog Title <span class="text-danger">*</span>
                </label>
                <input type="text" name="name" value="{{ $blog->name }}" placeholder="Enter blog title" class="form-control form-control-lg rounded-3 shadow-sm @error('name') is-invalid @enderror">
                @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <!-- Image + Category -->
              <div class="row g-3 mb-4">

                <!-- Image -->
                <div class="col-md-6">
                  <label class="form-label fw-semibold">
                    Blog Image <span class="text-muted">(Optional)</span>
                  </label>
                  <input type="file" name="image" class="form-control rounded-3 shadow-sm @error('image') is-invalid @enderror ">
                  @error('image')
                  <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>

                <!-- Category -->
                <div class="col-md-6 form-group">
                  <label class="form-label fw-semibold">
                    Category <span class="text-muted">(Optional)</span>
                  </label>
                  <select name="category_id" class="form-select form-control form-select-lg rounded-3 shadow-sm @error('category_id') is-invalid @enderror">
                    <option value="">Choose category</option>
                    @if (count($categories) > 0)
                    @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ $blog->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                    @endif
                  </select>
                  @error('category_id')
                  <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>

              </div>

              <!-- Description -->
              <div class="mb-5">
                <label class="form-label fw-semibold">
                  Blog Content <span class="text-danger">*</span>
                </label>
                <textarea name="description" rows="7" class="form-control form-group rounded-3 shadow-sm @error('description') is-invalid @enderror" placeholder="Write blog content here...">{{ $blog->description }}</textarea>
                @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <!-- Actions -->
              <div class="d-flex justify-content-between align-items-center form-group">
                <a href="{{ url()->previous() }}"
                  class="btn btn-outline-secondary rounded-pill px-4">
                  Cancel
                </a>

                <button type="submit" class="btn btn-primary btn-lg rounded-pill px-5 shadow">
                  🚀 Publish Blog
                </button>
              </div>

            </form>

          </div>
        </div>

      </div>
    </div>
  </div>
</section>

<!-- Optional Custom Style -->
<style>
  .form-control,
  .form-select {
    border-color: #dee2e6;
  }

  .form-control:focus,
  .form-select:focus {
    border-color: #0d6efd;
    box-shadow: 0 0 0 .2rem rgba(13, 110, 253, .15);
  }
</style>

@endsection