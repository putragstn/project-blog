<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
// use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::with('category', 'user')->where('user_id', auth()->user()->id)->get();
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
        $title = "Preview Post";
        $categories = Category::all();

        $months = collect();

        // Mulai dari bulan sekarang dan mundur 12 bulan
        for ($i = 0; $i < 12; $i++) {
            $months->push(Carbon::now()->subMonths($i)->format('F Y'));
        }

        return view('menu.post.show', compact('post', 'categories', 'title', 'months'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
        // $posts = Post::with('category' ,'user')->where('user_id', $post->id)->get();
        $title = "Edit Post";
        return view('menu.post.edit', compact('post', 'categories', 'title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'subheading' => 'nullable|string',
            'category_id' => 'exists:categories,id',
            'content' => 'required|string',
        ]);

        // membuat slug
        $slug = Str::slug($request->title);

        // Menangani duplikasi slug
        $existingSlug = Post::where('slug', $slug)->first();
        if ($existingSlug) {
            // Jika slug sudah ada, tambahkan angka untuk membuat slug unik
            $slug = $slug . '-' . (Post::where('slug', 'like', $slug.'%')->count() + 1);
        }

        // $post->update([
        //     'title'         => $request->title,
        //     'subheading'    => $request->subheading,
        //     'category_id'   => $request->category_id,
        //     'content'       => $request->content,
        // ]);

        $post->update(array_merge($validated, ['slug' => $slug]));
        // $post->update($validated);
        return redirect()->route('posts.index')->with('success', 'Post updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('posts.index')->with('success', 'Post deleted successfully!');
    }
}
