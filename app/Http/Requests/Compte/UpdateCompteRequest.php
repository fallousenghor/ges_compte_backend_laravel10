<?php

namespace App\Http\Requests\Compte;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCompteRequest extends FormRequest
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
            'numero' => ['sometimes', 'required', 'string', 'unique:comptes,numero,' . $this->compte->id],
            'type' => ['sometimes', 'required', 'string', 'in:Épargne,Chèque'],
            'solde' => ['sometimes', 'required', 'numeric', 'min:0'],
            'statut' => ['sometimes', 'required', 'string', 'in:Actif,Bloqué'],
            'dateCreation' => ['sometimes', 'required', 'date'],
            'user_id' => ['sometimes', 'required', 'uuid', 'exists:users,id']
        ];
    }
}
