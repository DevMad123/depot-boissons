<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTariftypeproduitembclientRequest extends FormRequest
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
            'typeclient' => 'required|max:50',
            'produit_id' => 'required|array',
            'produit_id.*' => 'required|integer|exists:produits,id',
            'tarifemballage' => 'required|array',
            'tarifemballage.*' => 'required|numeric|min:0',
        ];
    }
}
