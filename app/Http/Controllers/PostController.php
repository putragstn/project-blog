<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
// use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::with('category', 'user')->get();
        $title = "Post";
        return view('menu.post.index', compact('posts', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $title = "New Post";
        return view('menu.post.create', compact('categories', 'title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            // 'user_id' => 'required|exists:users,id',
            'title' => 'required|string|max:255',
            'subheading' => 'nullable|string',
            'category_id' => 'nullable|exists:categories,id',
            'content' => 'required|string',
            // 'published_at' => 'nullable|date',
        ]);

        // membuat slug
        $slug = Str::slug($request->title);

        // Menangani duplikasi slug
        $existingSlug = Post::where('slug', $slug)->first();
        if ($existingSlug) {
            // Jika slug sudah ada, tambahkan angka untuk membuat slug unik
            $slug = $slug . '-' . (Post::where('slug', 'like', $slug.'%')->count() + 1);
        }

        Post::create([
            'user_id'       => auth()->user()->id,
            'category_id'   => $request->category_id,
            'title'         => $request->title,
            'subheading'    => $request->subheading,
            'content'       => $request->content,
            'slug'          => $slug,
            'published_at'  => now()
        ]);

        return redirect()->route('posts.index')->with('success', 'Post berhasil dibuat!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }
}
