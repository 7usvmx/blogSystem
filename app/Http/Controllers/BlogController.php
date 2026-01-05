<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Requests\StoreBlogRequest;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{

  /**
   * Display a listing of the resource.
   */
  public function index() {}

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
  public function store(StoreBlogRequest $request)
  {


    $data = $request->validated();

    // Image processing
    // 1- Get image 
    $image = $request->image;
    // 2- Generate image name
    $newImageName = time() . "_" . base64_encode($image->getClientOriginalName()) . "." . $image->getClientOriginalExtension();
    // dd($newImageName, $request->file("image")->getClientOriginalName());
    // 3- Move image to public folder
    $image->storeAs("blogs/img", $newImageName, "public");
    // 4- Update image name in request
    $request->merge(["image" => $newImageName]);

    $data['image'] = $newImageName;
    $data['user_id'] = Auth::user()->id;

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
    // return view("theme.blogs.showBlog", compact("blog"));
    return "show";
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Blog $blog)
  {
    return "edit";
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, Blog $blog)
  {
    return "update";
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Blog $blog)
  {
    return "destroy";
  }
}
