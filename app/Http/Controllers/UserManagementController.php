<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class UserManagementController extends Controller
{
    // Menampilkan daftar pengguna
    public function index()
    {
        $users = User::all(); // Mengambil semua pengguna
        $title = "User Management";
        return view('menu.user-management.index', compact('users', 'title'));
    }

    // Menampilkan form untuk membuat pengguna baru
    public function create()
    {
        // Kode tidak dibutuhkan karena form input modal sudah ada di view
    }

    // Menyimpan pengguna baru
    public function store(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'role' => 'required|string|max:50',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,bmp,gif,svg|max:10240', // Validasi image
            'password' => 'required|string|min:8',
        ]);

        // Jika validasi gagal
        if ($validator->fails()) {
            return redirect()->route('users.index')
                             ->withErrors($validator)
                             ->withInput();
        }

        // Menangani upload file image
        $imagePath = null;
        if ($request->hasFile('image')) {

            // Ambil file gambar yang di-upload
            $image = $request->file('image');

            // Mendapatkan nama file asli
            $filename = $image->getClientOriginalName(); // Misalnya 'image.png'

            // Mendapatkan ekstensi file
            $extension = $image->getClientOriginalExtension(); // Misalnya 'png'

            // Menentukan path di storage/public tempat file disimpan
            $path = $image->storeAs('img/users', $filename, 'public'); // Menyimpan di storage/app/public/images/users/

            // Menyimpan path gambar pada database atau melanjutkan proses lainnya
            $imagePath = $path;
        }

        // Simpan pengguna baru
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role'  => $request->role,
            'image' => $request->image,
            'password' => Hash::make($request->password), // Hash password
        ]);

        return redirect()->route('users.index')->with('success', 'User created successfully!');
    }

    // Menampilkan detail pengguna tertentu
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('users.show', compact('user'));
    }

    // Menampilkan form untuk mengedit pengguna
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }

    // Mengupdate data pengguna
    public function update(Request $request, $id)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'role' => 'required',
            'status' => 'required'
        ]);

        // jika validasinya gagal maka redirect ke form edit user
        if ($validator->fails()) {
            return redirect()->route('users.index', $id)
                             ->withErrors($validator)
                             ->withInput();
        }

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->status = $request->status;
        

        $user->save();

        return redirect()->route('users.index')->with('success', 'User updated successfully!');
    }

    // Menghapus pengguna
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted successfully!');
    }
}
