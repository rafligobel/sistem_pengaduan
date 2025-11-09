<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreComplaintDataRequest extends FormRequest
{
    /**
     * Tentukan apakah user boleh membuat request ini.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Ambil aturan validasi yang berlaku untuk request ini.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'content' => 'required|string|min:20', // Memastikan isi pengaduan minimal 20 karakter
            'category_id' => 'required|integer|exists:categories,id', // Pastikan category_id ada di tabel categories

            // Penyempurnaan Keamanan: Validasi file yang lebih ketat
            'attachment' => [
                'nullable', // Boleh kosong
                'file',     // Harus berupa file
                'mimes:jpg,jpeg,png,pdf', // Hanya izinkan tipe file ini
                'max:2048', // Batasi ukuran file (misal: 2MB)
            ],
        ];
    }

    /**
     * Pesan kustom untuk validasi
     */
    public function messages(): array
    {
        return [
            'content.min' => 'Isi pengaduan minimal 20 karakter agar lebih rinci.',
            'category_id.required' => 'Anda harus memilih kategori pengaduan.',
            'category_id.exists' => 'Kategori yang dipilih tidak valid.',
            'attachment.mimes' => 'Lampiran harus berupa file: JPG, JPEG, PNG, atau PDF.',
            'attachment.max' => 'Ukuran lampiran maksimal adalah 2 MB.',
        ];
    }
}
