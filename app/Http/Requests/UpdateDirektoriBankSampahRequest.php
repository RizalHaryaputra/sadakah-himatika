<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateDirektoriBankSampahRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Izinkan jika pengguna adalah Super Admin
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
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'description' => 'nullable|string|max:255',
            'image_url' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'operation_hours' => 'nullable|string|max:255',
            'maps_embed' => 'nullable|string',
            'contact_person' => 'nullable|string|max:255',
            'phone_number' => 'nullable|string|max:15',
        ];
    }
}