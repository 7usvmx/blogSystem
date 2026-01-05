<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subscription;

class SubscriptionController extends Controller
{
  public function store(Request $request)
  {
    $request->validate([
      'email' => 'required|email|unique:subscriptions,email',
    ]);

    if (Subscription::create([
      'email' => $request->email,
    ])) {
      return redirect()->back()->with('success', 'Thank you for subscribing!');
    }
    return redirect()->back()->with('error', 'Something went wrong!');
  }
}
