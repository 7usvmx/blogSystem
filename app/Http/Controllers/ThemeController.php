<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Blog;
use Illuminate\Http\Request;

class ThemeController extends Controller
{

  public function index()
  {
    $blogs = Blog::paginate(4);
    return view("theme.homepage", compact("blogs"));
  }

  public function contact()
  {
    return "Contact";
  }


  public function categories($category)
  {
    $categoryID = Category::where('slug', $category)->firstOrFail()->id;
    // dd($category);
    $blogs = Blog::where('category_id', $categoryID)->paginate(3);
    return view("theme.categories", compact("blogs", "category"));
  }
}
