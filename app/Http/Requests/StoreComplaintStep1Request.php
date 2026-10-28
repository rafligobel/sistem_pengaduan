<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreComplaintStep1Request extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     * Validasi form pengaduan sesuai Perwako 2025 (5W+1H)
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            // Unsur 5W+1H
            'what'           => 'required|string|min:20',
            'who'            => 'required|string|min:10',
            'where_location' => 'required|string|min:10',
            'when_time'      => 'required|string|min:10',
            'why'            => 'nullable|string',
            'how'            => 'required|string|min:20',
            
            // Kategori tindak pidana korupsi (7 jenis + Tidak Diketahui)
            'category_id'    => 'required|exists:categories,id',
            
            // Bukti pendukung (multi-file)
            'attachments'    => 'nullable|array|max:5',
            'attachments.*'  => 'file|mimes:jpg,jpeg,png,pdf,doc,docx,mp4,mp3|max:10240',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'what.required'           => 'Uraian pelanggaran (Apa) wajib diisi.',
            'what.min'                => 'Uraian pelanggaran (Apa) minimal 20 karakter.',
            'who.required'            => 'Pihak yang terlibat (Siapa) wajib diisi.',
            'who.min'                 => 'Pihak yang terlibat (Siapa) minimal 10 karakter.',
            'where_location.required' => 'Lokasi kejadian (Di mana) wajib diisi.',
            'where_location.min'      => 'Lokasi kejadian (Di mana) minimal 10 karakter.',
            'when_time.required'      => 'Waktu kejadian (Kapan) wajib diisi.',
            'when_time.min'           => 'Waktu kejadian (Kapan) minimal 10 karakter.',
            'how.required'            => 'Modus operandi (Bagaimana) wajib diisi.',
            'how.min'                 => 'Modus operandi (Bagaimana) minimal 20 karakter.',
            'category_id.required'    => 'Kategori tindak pidana wajib dipilih.',
            'category_id.exists'      => 'Kategori yang dipilih tidak valid.',
            'attachments.max'         => 'Maksimal 5 file bukti yang dapat diunggah.',
            'attachments.*.max'       => 'Ukuran setiap file tidak boleh lebih dari 10MB.',
            'attachments.*.file'      => 'Bukti harus berupa file yang valid.',
            'attachments.*.mimes'     => 'Format file harus jpg, jpeg, png, pdf, doc, docx, mp4, atau mp3.',
        ];
    }
}
