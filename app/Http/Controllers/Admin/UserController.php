<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Menampilkan daftar user
    public function index()
    {
        $users = User::with('roles')->paginate(10);
        // return view('admin.users.index', compact('users'));
        // (Anda perlu membuat view-nya)
    }

    // Menampilkan form tambah user
    public function create()
    {
        $roles = Role::all();
        // return view('admin.users.create', compact('roles'));
    }

    // Menyimpan user baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'roles' => 'required|array'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->assignRole($request->roles);

        // return redirect()->route('admin.users.index')->with('success', 'User berhasil dibuat.');
    }

    // (Tambahkan method show, edit, update, destroy sesuai kebutuhan)
}
