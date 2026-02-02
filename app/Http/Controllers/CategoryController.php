<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;

class CategoryController extends Controller
{
    // /categories
    public function index()
    {
        // categories with post count
        $categories = Category::withCount('posts')
            ->orderBy('name')
            ->get();

        return view('categories.index', compact('categories'));
    }

    // /categories/{category}
    public function show(Category $category)
    {
        $posts = Post::where('category_id', $category->id)
            ->latest()
            ->paginate(10);

        return view('categories.show', compact('category', 'posts'));
    }
}
