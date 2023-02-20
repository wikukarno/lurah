<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserDetailRequest extends FormRequest
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
            'users_id' => 'integer',
            'nik' => 'required|integer|unique:user_details',
            'phone' => 'required|integer|max:13',
            'jenis_kelamin' => 'required|string',
            'tempat_lahir' => 'required|string',
            'tanggal_lahir' => 'required|string',
            'pekerjaan' => 'required|string',
            'rtrw' => 'required|string',
            'kelurahan' => 'required|string',
            'kecamatan' => 'required|string',
            'agama' => 'required|string',
            'status_perkawinan' => 'required|string',
            'address' => 'required|string',
            'avatar' => 'image|mimes:jpeg,jpg|max:2048',
            'ktp' => 'image|mimes:jpeg,jpg|max:2048',
            'kk' => 'image|mimes:jpeg,jpg|max:2048',

        ];
    }
}
