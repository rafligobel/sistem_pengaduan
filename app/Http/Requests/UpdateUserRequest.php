<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;

class UpdateUserRequest extends FormRequest
{
    /**
     * Tentukan apakah user boleh membuat request ini.
     */
    public function authorize(): bool
    {
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
            'nik' => [
                'nullable',
                'string',
                'digits:16',
                Rule::unique(User::class)->ignore($this->user->id),
            ],
            'phone' => 'nullable|string|max:20',
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                // Pastikan email unik, KECUALI untuk user yang sedang diedit
                Rule::unique(User::class)->ignore($this->user->id),
            ],
            // Password bersifat opsional saat update
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
            'role' => 'required|string|exists:roles,name', // Dropdown single-role
        ];
    }
}
