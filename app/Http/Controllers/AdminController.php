<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class AdminController extends Controller
{
    public function dashboard(){
        return view('user.dashboard', [
            'title'         => 'Admin Dashboard',
            'countCategory' => Category::count()
        ]);
    }
}
