<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
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

            // Mendapatkan ekstensi file
            $extension = $image->getClientOriginalExtension();

            // Validasi ekstensi untuk memastikan hanya gambar yang di-upload
            $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
            if (!in_array(strtolower($extension), $allowedExtensions)) {
                // Jika file bukan gambar, beri respon error
                return response()->json(['error' => 'Hanya file gambar yang diperbolehkan.'], 400);
            }

            // Membuat nama file unik dengan UUID dan ekstensi yang benar
            $filename = Str::uuid() . '.' . $extension;

            // Menentukan path di storage/public tempat file disimpan
            $image->storeAs('img/users', $filename, 'public'); // Menyimpan di storage/app/public/images/users/

            // Menyimpan path gambar pada database atau melanjutkan proses lainnya
            $imagePath = $filename;
        }

        // Simpan pengguna baru
        User::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'role'      => $request->role,
            'image'     => $imagePath,     // Jika tidak ada gambar, akan disimpan sebagai null
            'password'  => Hash::make($request->password), // Hash password
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
        // $user = User::findOrFail($id);
        // return view('users.edit', compact('user'));
    }

    // Mengupdate data pengguna
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);  // Mencari pengguna berdasarkan ID

        // Validasi input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'role' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,bmp,gif,svg|max:10240', // Validasi image
            // 'status' => 'required'
        ]);

        // Cek jika ada gambar baru yang di-upload
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($user->image && Storage::disk('public')->exists($user->image)) {
                Storage::disk('public')->delete($user->image);
            }

            // Ambil file gambar yang di-upload
            $image = $request->file('image');

            // Mendapatkan ekstensi file
            $extension = $image->getClientOriginalExtension();

            // Membuat nama file unik dengan UUID dan ekstensi yang benar
            $filename = Str::uuid() . '.' . $extension;

            // Menyimpan file gambar di storage/public/img/users/
            $image->storeAs('img/users', $filename, 'public');

            // Menyimpan filename gambar yang baru
            $imagePath = $filename;
        } else {
            // Jika tidak ada gambar yang di-upload, gunakan gambar lama
            $imagePath = $user->image;
        }

        // dd($request->status);

        // Perbarui data pengguna
        $user->update([
            'name'  => $validated['name'],
            'email' => $validated['email'],
            'role'  => $validated['role'],
            'image' => $imagePath,  // Update namafile baru atau lama
            // 'account_verified_at' => now(),
            'status'=> $request->status
        ]);

        // Redirect ke halaman pengguna dengan pesan sukses
        return redirect()->route('users.index')->with('success', 'User updated successfully!');
    }

    // Menghapus pengguna
    public function destroy($id)
    {
        // $user = User::findOrFail($id);
        // $user->delete();

        // return redirect()->route('users.index')->with('success', 'User deleted successfully!');

        $user = User::findOrFail($id);  // Mencari pengguna berdasarkan ID

        // Hapus gambar pengguna jika ada di storage
        if ($user->image && Storage::disk('public')->exists('img/users/' . $user->image)) {
            Storage::disk('public')->delete('img/users/' . $user->image);
        }

        // Hapus data pengguna dari database
        $user->delete();

        // Redirect ke halaman pengguna dengan pesan sukses
        return redirect()->route('users.index')->with('success', 'User deleted successfully!');
    }
}
