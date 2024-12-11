<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class UserController extends Controller
{
    public function dashboard(){
        return view('user.dashboard', [
            'title' => 'User Dashboard',
            'countCategory' => Category::count()
        ]);
    }
}
