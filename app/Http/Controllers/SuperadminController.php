<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\User;
use App\Models\Post;

class SuperadminController extends Controller
{
    public function dashboard(){
        return view('user.dashboard', [
          'title'         => 'Superadmin Dashboard',
          'countCategory' => Category::count(),
          'countUser'     => User::count(),
          'countPost'     => Post::where('user_id', auth()->id())->count(),
          'countAllPosts' => Post::count()
        ]);
      }
}
