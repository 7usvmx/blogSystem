<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class ThemeController extends Controller
{

  public function index()
  {
    return view("theme.homepage");
  }

  public function contact()
  {
    return view("theme.homepage");
  }
}
