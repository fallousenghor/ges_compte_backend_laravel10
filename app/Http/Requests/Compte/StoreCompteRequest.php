<?php

namespace App\Http\Requests\Compte;

use Illuminate\Foundation\Http\FormRequest;

class StoreCompteRequest extends FormRequest
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
            'numero' => ['required', 'string', 'unique:comptes,numero'],
            'type' => ['required', 'string', 'in:Épargne,Chèque'],
            'solde' => ['required', 'numeric', 'min:0'],
            'statut' => ['required', 'string', 'in:Actif,Bloqué'],
            'dateCreation' => ['required', 'date'],
            'user_id' => ['required', 'uuid', 'exists:users,id']
        ];
    }
}
