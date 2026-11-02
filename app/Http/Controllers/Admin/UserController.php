<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{
    /**
     * Tampilkan daftar semua user.
     */
    public function index()
    {
        // Ambil user, eager load roles mereka, dan paginate
        $users = User::with('roles')->latest()->paginate(10);
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
    public function store(StoreUserRequest $request)
    {
        $validatedData = $request->validated();

        // Buat user baru
        $user = User::create([
            'name' => $validatedData['name'],
            'nik' => $validatedData['nik'] ?? null,
            'phone' => $validatedData['phone'] ?? null,
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
        ]);

        // Tetapkan role tunggal ke user (mencegah double role)
        $role = $validatedData['role'] ?? ($validatedData['roles'][0] ?? 'masyarakat');
        $user->syncRoles([$role]);

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
    public function update(UpdateUserRequest $request, User $user)
    {
        $validatedData = $request->validated();

        // Siapkan data untuk diupdate
        $updateData = [
            'name' => $validatedData['name'],
            'nik' => $validatedData['nik'] ?? null,
            'phone' => $validatedData['phone'] ?? null,
            'email' => $validatedData['email'],
        ];

        // Cek jika password baru diisi
        if (!empty($validatedData['password'])) {
            $updateData['password'] = Hash::make($validatedData['password']);
        }

        // Update user
        $user->update($updateData);

        // Update role tunggal (mencegah double role)
        $role = $validatedData['role'] ?? ($validatedData['roles'][0] ?? null);
        if ($role) {
            $user->syncRoles([$role]);
        }

        return redirect()->route('admin.users.index')
            ->with('success', 'User berhasil diperbarui.');
    }

    /**
     * Hapus SEMUA user (Kecuali Admin Login)
     */
    public function destroyAll()
    {
        // Hapus semua kecuali diri sendiri
        User::where('id', '!=', auth()->id())->delete();

        return redirect()->route('admin.users.index')
            ->with('success', 'Semua user berhasil dihapus (kecuali akun Anda).');
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
