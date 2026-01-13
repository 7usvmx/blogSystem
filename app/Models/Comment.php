<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
  protected $fillable = [
    'name',
    'email',
    // 'subject',
    'commentBody',
    'blog_id',
    'user_id',
  ];

  public function blog()
  {
    return $this->belongsTo(Blog::class);
  }

  public function user()
  {
    return $this->belongsTo(User::class);
  }
}
