<?php

namespace App\Http\Controllers;

use App\Models\Post;

class DashboardController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->take(10)->get(); // show latest 10
        return view('dashboard', compact('posts'));
    }
}
