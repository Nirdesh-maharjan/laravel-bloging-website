<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;   // ✅ add this
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Notifications\BasicNotification;


class PostController extends Controller
{
    
    public function create()
    {
        // ✅ Load categories from DB for the dropdown
        $categories = Category::orderBy('name')->get();

        return view('posts.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required','string','max:255'],
            'slug' => ['nullable','string','max:255'],

            // ✅ validate properly against categories table
            'category_id' => ['nullable','exists:categories,id'],

            'status' => ['required','in:draft,published'],
            'content' => ['required'],
            'image' => ['nullable','image','mimes:jpg,jpeg,png,webp','max:2048'],
        ]);
        Post::create([
            'title' => $request->title,
            'slug' => $slug,
            'category_id' => $request->category_id,
            'status' => $request->status,
            'image_path' => $imagePath,
            'content' => $request->content,
        ]);

            auth()->user()->notify(new BasicNotification(
                'Post created ✅',
                "“{$post->title}” was created successfully.",
                route('posts.show', $post)
            ));
        // slug auto-generate if empty
        $slug = $request->slug
            ? Str::slug($request->slug)
            : Str::slug($request->title);

        // ensure unique slug
        $original = $slug;
        $i = 1;
        while (Post::where('slug', $slug)->exists()) {
            $slug = $original . '-' . $i;
            $i++;
        }

        // upload image (optional)
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('posts', 'public');
        }

        Post::create([
            'user_id' => auth()->id(), // ✅ add this
            'title' => $request->title,
            'slug' => $slug,
            'category_id' => $request->category_id,
            'status' => $request->status,
            'image_path' => $imagePath,
            'content' => $request->content,
        ]);

        return redirect('/dashboard')->with('success', 'Post created successfully!');
    }

    public function index(Request $request)
    {
        $q = $request->query('q');

        $posts = Post::query()
            ->when($q, function ($query) use ($q) {
                $query->where('title', 'like', "%{$q}%")
                      ->orWhere('content', 'like', "%{$q}%");
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('posts.index', compact('posts', 'q'));
    }

    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }
    public function myPosts(Request $request)
{
    $q = $request->query('q');

    $posts = Post::where('user_id', auth()->id())
        ->when($q, function ($query) use ($q) {
            $query->where('title', 'like', "%{$q}%")
                  ->orWhere('content', 'like', "%{$q}%");
        })
        ->latest()
        ->paginate(10)
        ->withQueryString();

    return view('posts.mine', compact('posts', 'q'));
}

public function edit(Post $post)
{
    // ✅ Owner check
    abort_if($post->user_id !== auth()->id(), 403);

    $categories = Category::orderBy('name')->get();
    return view('posts.edit', compact('post', 'categories'));
}

public function update(Request $request, Post $post)
{
    abort_if($post->user_id !== auth()->id(), 403);

    $request->validate([
        'title' => ['required','string','max:255'],
        'slug' => ['nullable','string','max:255'],
        'category_id' => ['nullable','exists:categories,id'],
        'status' => ['required','in:draft,published'],
        'content' => ['required'],
        'image' => ['nullable','image','mimes:jpg,jpeg,png,webp','max:2048'],
    ]);

    $slug = $request->slug ? Str::slug($request->slug) : Str::slug($request->title);

    // unique slug except current post
    $original = $slug;
    $i = 1;
    while (Post::where('slug', $slug)->where('id', '!=', $post->id)->exists()) {
        $slug = $original . '-' . $i;
        $i++;
    }

    // image update (optional)
    if ($request->hasFile('image')) {
        if ($post->image_path) {
            Storage::disk('public')->delete($post->image_path);
        }
        $post->image_path = $request->file('image')->store('posts', 'public');
    }

    $post->title = $request->title;
    $post->slug = $slug;
    $post->category_id = $request->category_id;
    $post->status = $request->status;
    $post->content = $request->content;
    $post->save();

    return redirect()->route('posts.mine')->with('success', 'Post updated ✅');
}

public function destroy(Post $post)
{
    abort_if($post->user_id !== auth()->id(), 403);

    if ($post->image_path) {
        Storage::disk('public')->delete($post->image_path);
    }

    $post->delete();

    return redirect()->route('posts.mine')->with('success', 'Post deleted ✅');
}

}
