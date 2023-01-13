<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BusinessCertificationRequest extends FormRequest
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
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'letters_id' => 'integer',
            'users_id' => 'integer',
            'nama_usaha' => 'required|string',
            'jenis_usaha' => 'required|string',
            'surat_rtrw' => 'image|mimes:jpeg,jpg|max:2048',
            'alasan_penolakan' => 'nullable|string',
            'posisi' => 'string',
            'status' => 'string',
        ];
    }
}
