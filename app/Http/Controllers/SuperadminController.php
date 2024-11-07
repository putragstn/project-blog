<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class SuperadminController extends Controller
{
    public function dashboard(){
        return view('user.dashboard', [
          'title' => 'Superadmin Dashboard',
          'countCategory' => Category::count()
        ]);
      }
}
