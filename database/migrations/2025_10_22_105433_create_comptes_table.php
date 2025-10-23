<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('comptes', function (Blueprint $table) {
            $table->id();
            $table->string('numero')->unique();
            $table->enum('type', ['Épargne', 'Chèque']);
            $table->decimal('solde', 15, 2)->default(0);
            $table->enum('statut', ['Actif', 'Bloqué'])->default('Actif');
            $table->date('dateCreation');
            $table->uuid('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();

            // Index pour optimiser les recherches
            $table->index('type');
            $table->index('statut');
            $table->index('dateCreation');
            $table->index(['user_id', 'type']); // Index composite pour les recherches de comptes par utilisateur et type
            $table->index(['user_id', 'statut']); // Index composite pour les recherches de comptes par utilisateur et statut
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comptes');
    }
};
