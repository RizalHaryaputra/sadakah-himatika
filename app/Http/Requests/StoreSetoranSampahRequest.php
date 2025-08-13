<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSetoranSampahRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this re quest.
     */
    public function authorize(): bool
    {
        // Izinkan jika user adalah Super Admin atau Operator Padukuhan
        return auth()->check() && auth()->user()->hasAnyRole(['Super Admin', 'Operator Padukuhan']);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'nasabah_id'          => 'required|exists:users,id',
            'kategori_sampah_id'  => 'required|exists:kategori_sampah,id',
            'weight_kg'           => 'required|numeric|min:0.01',
            'collection_date'     => 'required|date',
            'notes'               => 'nullable|string|max:255',
        ];
    }
}