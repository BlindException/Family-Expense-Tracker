<?php

namespace App\Http\Requests;

use App\Models\Family;
use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;

class StoreFamilyUserRequest extends FormRequest
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
    public function rules(Request $request)
    {
        $family = Family::where('name', '=', $request->input('name'))->firstOrFail();
                return [
            'family_id' => [$family->id],
            'user_id' => [auth()->user()->id],
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
