<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class AllPostsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $allPosts = Post::all();
        $title = "All Posts";
        return view('menu.all-posts.index', compact('allPosts', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(AllPosts $allPosts)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AllPosts $allPosts)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AllPosts $allPosts)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AllPosts $allPosts)
    {
        //
    }
}
