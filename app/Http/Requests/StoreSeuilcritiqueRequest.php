<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSeuilcritiqueRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $adminId = $this->route('admin');

        return [
            'produit_id' => [
                'required',
                'unique:seuilcritiques,produit_id', // Vérifie que produit_id est unique dans la table seuilcritiques
            ],
            'seuilcritique' => 'required|numeric|min:0', // Validation supplémentaire pour s'assurer que seuilcritique est un nombre positif
        ];
    }
}
