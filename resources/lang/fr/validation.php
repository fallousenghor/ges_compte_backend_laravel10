<?php

return [
    'custom' => [
        'prenom' => [
            'required' => 'Le prénom est requis',
            'string' => 'Le prénom doit être une chaîne de caractères',
            'max' => 'Le prénom ne doit pas dépasser 255 caractères',
        ],
        'nom' => [
            'required' => 'Le nom est requis',
            'string' => 'Le nom doit être une chaîne de caractères',
            'max' => 'Le nom ne doit pas dépasser 255 caractères',
        ],
        'email' => [
            'required' => 'L\'email est requis',
            'string' => 'L\'email doit être une chaîne de caractères',
            'email' => 'L\'email doit être valide',
            'unique' => 'Cet email est déjà utilisé',
        ],
        'telephone' => [
            'required' => 'Le téléphone est requis',
            'max' => 'Le numéro ne doit pas dépasser 20 caractères',
        ],
        'adresse' => [
            'required' => 'L\'adresse est requise',
        ],
        'role' => [
            'required' => 'Le rôle est requis',
            'in' => 'Le rôle doit être soit admin, soit user',
        ],
        'password' => [
            'required' => 'Le mot de passe est requis',
            'min' => 'Le mot de passe doit contenir au moins 8 caractères',
            'confirmed' => 'La confirmation du mot de passe ne correspond pas',
        ],
        'numero' => [
            'required' => 'Le numéro de compte est obligatoire',
            'unique' => 'Ce numéro de compte existe déjà',
            'string' => 'Le numéro de compte doit être une chaîne de caractères',
        ],
        'type' => [
            'required' => 'Le type de compte est obligatoire',
            'in' => 'Le type de compte doit être soit Épargne, soit Chèque',
            'string' => 'Le type de compte doit être une chaîne de caractères',
        ],
        'solde' => [
            'required' => 'Le solde est obligatoire',
            'numeric' => 'Le solde doit être un nombre',
            'min' => 'Le solde ne peut pas être négatif',
        ],
        'statut' => [
            'required' => 'Le statut est obligatoire',
            'in' => 'Le statut doit être soit Actif, soit Bloqué',
            'string' => 'Le statut doit être une chaîne de caractères',
        ],
        'dateCreation' => [
            'required' => 'La date de création est obligatoire',
            'date' => 'La date de création doit être une date valide',
        ],
        'user_id' => [
            'required' => 'Le titulaire du compte est obligatoire',
            'exists' => 'Le titulaire sélectionné n\'existe pas',
            'uuid' => 'L\'identifiant du titulaire n\'est pas valide',
        ],
    ],
];
