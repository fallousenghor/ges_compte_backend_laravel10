Compte - Collection Postman
=========================

Ce dossier contient une collection Postman (`Compte.postman_collection.json`) pour tester la création d'un compte via l'endpoint POST /api/comptes.

Pré-requis
----------

- Laravel en cours d'exécution (par exemple `php artisan serve` ou via votre setup Docker).
- Avoir un `user_id` valide présent dans la base (les utilisateurs utilisent ici des UUIDs). Vous pouvez créer un user via votre endpoint d'API ou via une commande tinker.

Import et utilisation
---------------------

1. Ouvrir Postman et importer le fichier `Compte.postman_collection.json`.
2. Créer un environnement Postman ou utiliser les variables globales et définir :
   - `baseUrl` : l'URL de base de l'API (par défaut `http://localhost:8000`).
   - `user_id` : UUID d'un utilisateur existant dans la BDD.
3. Lancer la requête "Create Compte" (POST /api/comptes).

Corps d'exemple attendu
-----------------------

{
  "type": "Épargne",
  "solde": 1000.50,
  "statut": "Actif",
  "dateCreation": "2025-10-22",
  "user_id": "<uuid de l'utilisateur>"
}

Tests inclus
------------

- Vérifie que le statut HTTP est 201.
- Vérifie que la réponse contient `data.id` et `data.numero` qui commence par `CPT-`.
- Sauvegarde `created_compte_id` dans l'environnement Postman pour des tests ultérieurs.

Remarques
--------

- Le champ `numero` est généré automatiquement par le modèle; il ne doit pas être fourni dans le body. Le format attendu commence par `CPT-YYYYMMDD-xxxxx`.
- Les règles de validation sont définies dans `app/Http/Requests/Compte/StoreCompteRequest.php`.
