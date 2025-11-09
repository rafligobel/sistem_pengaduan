<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreResponseRequest extends FormRequest
{
    /**
     * Tentukan apakah user boleh membuat request ini.
     * Kita set true karena otentikasi sudah dihandle di route middleware.
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
            // Variabel 'content' sudah benar
            'content' => 'required|string',
            // Variabel 'status' sudah benar
            'status' => 'required|string|in:pending,processed,finished,rejected',
        ];
    }
}
