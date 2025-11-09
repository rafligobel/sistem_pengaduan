<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreUserRequest;   // <-- 1. Import Request Baru
use App\Http\Requests\UpdateUserRequest; // <-- 2. Import Request Baru

class UserController extends Controller
{
    /**
     * Tampilkan daftar semua user.
     */
    public function index()
    {
        // Ambil user, eager load roles mereka, dan paginate
        $users = User::with('roles')->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    /**
     * Tampilkan form untuk membuat user baru.
     */
    public function create()
    {
        // Ambil semua roles untuk ditampilkan di form
        $roles = Role::all();
        return view('admin.users.create', compact('roles'));
    }

    /**
     * Simpan user baru ke database.
     */
    // 3. Gunakan StoreUserRequest
    public function store(StoreUserRequest $request)
    {
        $validatedData = $request->validated();

        // Buat user baru
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
        ]);

        // Tetapkan roles ke user
        $user->syncRoles($validatedData['roles']);

        return redirect()->route('admin.users.index')
            ->with('success', 'User berhasil dibuat.');
    }

    /**
     * Tampilkan form untuk mengedit user.
     */
    public function edit(User $user)
    {
        $roles = Role::all();
        // Eager load roles yang dimiliki user
        $user->load('roles');
        return view('admin.users.edit', compact('user', 'roles'));
    }

    /**
     * Update user di database.
     */
    // 4. Gunakan UpdateUserRequest
    public function update(UpdateUserRequest $request, User $user)
    {
        $validatedData = $request->validated();

        // Siapkan data untuk diupdate
        $updateData = [
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
        ];

        // Cek jika password baru diisi
        if (!empty($validatedData['password'])) {
            $updateData['password'] = Hash::make($validatedData['password']);
        }

        // Update user
        $user->update($updateData);

        // Update roles
        $user->syncRoles($validatedData['roles']);

        return redirect()->route('admin.users.index')
            ->with('success', 'User berhasil diperbarui.');
    }

    /**
     * Hapus user dari database.
     */
    public function destroy(User $user)
    {
        // Tambahkan perlindungan agar admin tidak bisa menghapus diri sendiri
        if ($user->id == auth()->id()) {
            return redirect()->route('admin.users.index')
                ->with('error', 'Anda tidak dapat menghapus akun Anda sendiri.');
        }

        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('success', 'User berhasil dihapus.');
    }
}
