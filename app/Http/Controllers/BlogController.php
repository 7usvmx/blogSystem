<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Requests\StoreBlogRequest;
use App\Http\Requests\EditBlogRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class BlogController extends Controller implements HasMiddleware
{

  public static function middleware(): array
  {
    return [
      new Middleware('auth', except: ['show']),
    ];
  }


  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $blogs = Blog::where("user_id", Auth::user()->id)->get();
    return view("theme.blogs.myBlogs", compact("blogs"));
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    $categories = Category::all();
    return view("theme.blogs.addBlog", compact("categories"));
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(StoreBlogRequest $validatedRequest)
  {


    // $data = $validatedRequest->validated();
    $data = $validatedRequest->validated();

    // Image processing
    // 1- Get image 
    $image = $validatedRequest->image;
    // 2- Generate image name
    $newImageName = time() . "_" . base64_encode($image->getClientOriginalName()) . "." . $image->getClientOriginalExtension();
    // dd($newImageName, $validatedRequest->file("image")->getClientOriginalName());
    // 3- Move image to public folder
    $image->storeAs("blogs/img", $newImageName, "public");
    // 4- Update image name in request
    // $validatedRequest->merge(["image" => $newImageName]);

    $data['image'] = $newImageName;
    $data['user_id'] = Auth::user()->id;

    // dd($validatedRequest);

    if (Blog::create($data)) {
      return redirect()->back()->with("success", "Blog created successfully");
    } else {
      return redirect()->back()->with("error", "Blog created failed");
    }
  }

  /**
   * Display the specified resource.
   */
  public function show(Blog $blog)
  {
    return view("theme.blogs.single-blog", compact("blog"));
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Blog $blog)
  {

    if (Auth::user()->id != $blog->user_id) {
      abort(403, "You are not authorized to edit this blog");
    }
    $categories = Category::all();
    return view("theme.blogs.editBlog", compact("blog", "categories"));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(EditBlogRequest $request, Blog $blog)
  {
    if (Auth::user()->id != $blog->user_id) {
      abort(403, "You are not authorized to edit this blog");
    }

    $data = $request->validated();

    // Image processing
    // 1- Get image 

    if ($request->hasFile("image")) {


      // Delete old image
      if ($blog->image) {
        Storage::delete("blogs/img/" . $blog->image);
      }
      $image = $request->image;
      // 2- Generate image name
      $newImageName = time() . "_" . base64_encode($image->getClientOriginalName()) . "." . $image->getClientOriginalExtension();
      // dd($newImageName, $validatedRequest->file("image")->getClientOriginalName());
      // 3- Move image to public folder
      $image->storeAs("blogs/img", $newImageName, "public");
      // 4- Update image name in request
      $data['image'] = $newImageName;
    }

    $data['user_id'] = Auth::user()->id;

    if ($blog->update($data)) {
      return redirect()->back()->with("success", "Blog updated successfully");
    } else {
      return redirect()->back()->with("error", "Blog updated failed");
    }
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Blog $blog)
  {
    if (Auth::user()->id != $blog->user_id) {
      abort(403, "You are not authorized to delete this blog");
    }
    if ($blog->delete()) {
      return redirect()->back()->with("success", "Blog deleted successfully");
    } else {
      return redirect()->back()->with("error", "Blog deleted failed");
    }
  }
}
