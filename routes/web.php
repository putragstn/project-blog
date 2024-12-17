<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SuperadminController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AllPostsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use App\Models\Category;

Route::get('/', function () {
    return view('home', [
        'title'         => 'Breaking News',
        'categories'    => Category::all()
    ]);
});

Route::get('/dashboard', function () {
    return view('user.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// superadmin routes
Route::middleware(['auth', 'verified', 'role:superadmin'])->group(function () {
    Route::get('/superadmin/dashboard',[SuperadminController::class,'dashboard'])->name('superadmin.dashboard');
});


Route::middleware(['auth', 'verified', 'role:superadmin,admin'])->group(function () {
    Route::resource('category', CategoryController::class); 
    Route::resource('users', UserManagementController::class); 
    Route::resource('all-posts', AllPostsController::class);
});


// admin routes
Route::middleware(['auth', 'verified', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard',[AdminController::class,'dashboard'])->name('admin.dashboard');
});

// user routes
Route::middleware(['auth', 'verified', 'role:user'])->group(function () {
    Route::get('/user/dashboard',[UserController::class,'dashboard'])->name('user.dashboard');
});


// my posts routes
Route::middleware(['auth', 'verified', 'role:superadmin,admin,user'])->group(function () {
    Route::resource('posts', PostController::class); 
});


require __DIR__.'/auth.php';
