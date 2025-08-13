<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreHadiahRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Hanya Super Admin yang bisa menambah hadiah baru
        return Auth::check() && Auth::user()->hasRole('Super Admin');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name'          => 'required|string|max:255|unique:hadiah,name',
            'description'   => 'nullable|string|max:255',
            'point_cost'    => 'required|integer|min:1',
            'stock'         => 'required|integer|min:0',
            'image_url'     => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'is_active'     => 'required|boolean',
        ];
    }
}