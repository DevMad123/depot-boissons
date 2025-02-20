<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClientRequest extends FormRequest
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
         //|image|mimes:jpeg,png,jpg,gif|max:2048
        return [
            'nom' => 'required|max:50',
            'email' => 'required|max:100|email|unique:clients,email,' ,
            'telephone' => 'required|max:100',
            'adress' => 'required|max:100',
            'solde' => 'nullable|max:100' ,
           // 'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'fraistva' => 'required|max:100' ,
            'fraisairsi' => 'required|max:100',
            'typeclient_id' => 'required|max:100',
        ];
    }
}
