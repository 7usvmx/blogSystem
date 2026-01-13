@extends('layouts.themelayout.master')
@section('title', 'Home')
@section('content')


<div class="container py-5">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold">My Blogs</h2>
    <a href="{{ route('blog.create') }}" class="btn btn-primary">Create New Blog</a>
  </div>

  @if (session()->has('success'))
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    <i class="ti-check me-1"></i>
    {{ session('success') }}
    <!-- <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> -->
  </div>
  @endif

  @if (session()->has('error'))
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <i class="ti-check me-1"></i>
    {{ session('error') }}
    <!-- <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> -->
  </div>
  @endif

  <div class="card shadow-sm">
    <div class="card-body p-0">
      <div class="table-responsive">
        <table class="table table-hover mb-0">
          <thead class="table-light">
            <tr>
              <th class="ps-4">#</th>
              <th>Blog Title</th>
              <th>Category</th>
              <th>Status</th>
              <th>Date Created</th>
              <th class="text-end pe-4">Actions</th>
            </tr>
          </thead>
          <tbody>
            @if (count($blogs) > 0)
            @foreach ($blogs as $blog)
            <tr>
              <td class="ps-4">{{ $loop->iteration }}</td>
              <td><span class="fw-semibold">{{ $blog->name }}</span></td>
              <td>{{ $blog->category->name }}</td>
              <td><span class="badge bg-success text-white">Published</span></td>
              <td>{{ $blog->created_at->format('M d, Y') }}</td>
              <td class="text-end pe-4">
                <a class="btn btn-sm btn-outline-primary" href="{{ route('blog.show', $blog) }}">View</a>
                <a class="btn btn-sm btn-outline-secondary me-1" href="{{ route('blog.edit', $blog) }}">Edit</a>
                <form action="{{ route('blog.destroy', $blog) }}" method="POST" class="d-inline">
                  @csrf
                  @method('DELETE')
                  <button type="submit" id="delete-btn" class="btn btn-sm btn-outline-danger">Delete</button>
                  <script>
                    document.querySelectorAll('#delete-btn').forEach(button => {
                      button.onclick = function(e) {
                        e.preventDefault();
                        const form = this.closest('form');
                        Swal.fire({
                          title: 'Are you sure?',
                          text: "You won't be able to revert this!",
                          icon: 'warning',
                          showCancelButton: true,
                          confirmButtonColor: '#d33',
                          cancelButtonColor: '#6c757d',
                          confirmButtonText: 'Yes, delete it!'
                        }).then((result) => {
                          if (result.isConfirmed) {
                            form.submit();
                          }
                        });
                      };
                    });
                  </script>
                </form>
              </td>
            </tr>
            @endforeach
            @else
            <tr>
              <td colspan="6" class="text-center">
                <h3>No blogs found</h3>
              </td>
            </tr>
            @endif
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>


@endsection