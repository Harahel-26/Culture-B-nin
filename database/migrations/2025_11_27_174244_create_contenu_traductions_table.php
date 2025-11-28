<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contenu_traductions', function (Blueprint $table) {
            $table->id();

            // Le contenu d'origine
            $table->foreignId('contenu_id')
                  ->constrained('contenus')
                  ->onDelete('cascade');

            // Langue dans laquelle c'est traduit
            $table->foreignId('langue_id')
                  ->constrained('langues')
                  ->onDelete('cascade');

            // L'utilisateur qui a produit la traduction
            $table->foreignId('traduit_par')
                  ->nullable()
                  ->constrained('users')
                  ->onDelete('set null');

            // Texte traduit
            $table->text('titre')->nullable();
            $table->text('description')->nullable();
            $table->longText('contenu_texte')->nullable();

            // Statut (pending / validated / rejected)
            $table->enum('status', ['pending', 'validated', 'rejected'])
                  ->default('pending');

            // Validateur admin/modérateur
            $table->foreignId('validated_by')
                  ->nullable()
                  ->constrained('users')
                  ->onDelete('set null');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contenu_traductions');
    }
};
