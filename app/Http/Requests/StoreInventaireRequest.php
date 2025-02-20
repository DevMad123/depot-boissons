<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreInventaireRequest extends FormRequest
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
        return [
            'produit_id' => 'required|exists:produits,id',
            'quantite_physique' => 'required|integer',
            'quantite_enregistre' => 'required|integer',
            'date_inventaire' => 'required|date',
            'observation' => 'nullable|string',
        ];
    }
}
