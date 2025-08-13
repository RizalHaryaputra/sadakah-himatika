<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Hanya Super Admin yang boleh membuat pengguna baru
        return auth()->check() && auth()->user()->hasRole('Super Admin');
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|string|exists:roles,name', // Pastikan role yang dikirim valid
            'padukuhan_id' => 'nullable|exists:padukuhan,id',
            'phone_number' => 'nullable|string|max:15',
            'address' => 'nullable|string|max:255',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ];
    }
}