<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateComplaintStatusRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('process_complaints') 
            || $this->user()->can('verify_complaints')
            || $this->user()->hasAnyRole(['admin', 'tim khusus']);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'status' => ['required', Rule::in(['menunggu', 'diproses', 'terverifikasi', 'ditolak'])],
            'note'   => ['nullable', 'string', 'max:1000'],
        ];
    }
}
