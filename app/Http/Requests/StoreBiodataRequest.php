<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBiodataRequest extends FormRequest
{
    /**
     * Tentukan apakah user boleh membuat request ini.
     * Karena ini form publik, kita set true.
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
            'nama_pelapor' => 'required|string|max:255',
            'email_pelapor' => 'required|string|email|max:255',
            // Penyempurnaan: Validasi nomor telepon yang lebih baik
            'telepon_pelapor' => 'required|string|regex:/^[0-9]+$/|min:10|max:15',
        ];
    }

    /**
     * Pesan kustom untuk validasi (Opsional namun disarankan)
     */
    public function messages(): array
    {
        return [
            'telepon_pelapor.regex' => 'Nomor telepon hanya boleh berisi angka.',
            'telepon_pelapor.min' => 'Nomor telepon minimal 10 digit.',
            'telepon_pelapor.max' => 'Nomor telepon maksimal 15 digit.',
        ];
    }
}
