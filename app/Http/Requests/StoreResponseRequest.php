<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreResponseRequest extends FormRequest
{
    /**
     * Tentukan apakah user boleh membuat request ini.
     */
    public function authorize(): bool
    {
        return $this->user()->can('respond_complaints') || $this->user()->hasRole('admin');
    }

    /**
     * Ambil aturan validasi yang berlaku untuk request ini.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'content' => 'required|string',
            'status'  => 'nullable|string|in:menunggu,diproses,terverifikasi,ditolak',
        ];
    }
}
