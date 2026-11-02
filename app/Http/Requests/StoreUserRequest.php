<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules;

class StoreUserRequest extends FormRequest
{
    /**
     * Tentukan apakah user boleh membuat request ini.
     */
    public function authorize(): bool
    {
        // Pastikan hanya user dengan role 'admin' yang bisa
        return $this->user()->hasRole('admin');
    }

    /**
     * Persiapkan data sebelum validasi (dukung single-role dropdown).
     */
    protected function prepareForValidation(): void
    {
        if (!$this->has('role') && $this->has('roles')) {
            $roles = (array) $this->input('roles');
            $this->merge(['role' => $roles[0] ?? null]);
        }
    }

    /**
     * Ambil aturan validasi yang berlaku untuk request ini.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'nik' => 'nullable|string|digits:16|unique:users,nik',
            'phone' => 'nullable|string|max:20',
            'email' => 'required|string|lowercase|email|max:255|unique:users',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => 'required|string|exists:roles,name', // Dropdown single-role
        ];
    }
}
