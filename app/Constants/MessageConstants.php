<?php

namespace App\Constants;

class MessageConstants
{
    // Success Messages
    public const OPERATION_SUCCESSFUL = 'Opération réussie';
    public const CREATED_SUCCESSFULLY = 'Ressource créée avec succès';
    public const UPDATED_SUCCESSFULLY = 'Ressource mise à jour avec succès';
    public const DELETED_SUCCESSFULLY = 'Ressource supprimée avec succès';
    public const RETRIEVED_SUCCESSFULLY = 'Ressource récupérée avec succès';
    public const LIST_RETRIEVED_SUCCESSFULLY = 'Liste récupérée avec succès';

    // Error Messages
    public const ERROR_OCCURRED = 'Une erreur est survenue';
    public const NOT_FOUND = 'Ressource non trouvée';
    public const VALIDATION_ERROR = 'Erreur de validation';
    public const UNAUTHORIZED = 'Non autorisé';
    public const FORBIDDEN = 'Accès interdit';

    // Authentication Messages
    public const LOGIN_SUCCESS = 'Connexion réussie';
    public const LOGIN_FAILED = 'Échec de la connexion';
    public const LOGOUT_SUCCESS = 'Déconnexion réussie';
    public const INVALID_CREDENTIALS = 'Identifiants invalides';
    public const TOKEN_INVALID = 'Token invalide';
    public const TOKEN_EXPIRED = 'Token expiré';

    // Resource Specific Messages
    public const USER_CREATED = 'Utilisateur créé avec succès';
    public const USER_UPDATED = 'Utilisateur mis à jour avec succès';
    public const USER_DELETED = 'Utilisateur supprimé avec succès';
    public const USER_NOT_FOUND = 'Utilisateur non trouvé';

    public const COMPTE_CREATED = 'Compte créé avec succès';
    public const COMPTE_UPDATED = 'Compte mis à jour avec succès';
    public const COMPTE_DELETED = 'Compte supprimé avec succès';
    public const COMPTE_NOT_FOUND = 'Compte non trouvé';
    public const COMPTE_BLOCKED = 'Compte bloqué';
    public const COMPTE_ACTIVATED = 'Compte activé';
    public const INSUFFICIENT_BALANCE = 'Solde insuffisant';

    // Validation Messages
    public const INVALID_DATA = 'Données invalides';
    public const REQUIRED_FIELDS_MISSING = 'Champs requis manquants';
    public const INVALID_FORMAT = 'Format invalide';
}
