<?php

namespace App\Http\Controllers;


use App\Http\Requests\AddCommentRequest;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CommentController extends Controller
{
  public function store(AddCommentRequest $request)
  {
    $data = $request->validated();

    if (isset(Auth::user()->id)) {
      $data['user_id'] = Auth::user()->id;
    }

    // dd($data);

    if (Comment::create($data)) {
      return redirect()->back()->with("CommentCreateStatus", "Commented successfully");
    } else {
      return redirect()->back()->with("CommentFailedStatus", "Comment add failed");
    }
  }
}
