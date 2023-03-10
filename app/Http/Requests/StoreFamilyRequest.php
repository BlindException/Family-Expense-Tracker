<?php

namespace App\Http\Requests;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Foundation\Http\FormRequest;

class StoreFamilyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (auth()->user()) {
            return true;
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(Request $request)
    {
        Crypt::encryptString($request->input('password'));
        return [
            'name' => ['required', 'string', 'unique:families', 'max:255'],
            'password' => ['required', 'string', 'max:255'],
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
