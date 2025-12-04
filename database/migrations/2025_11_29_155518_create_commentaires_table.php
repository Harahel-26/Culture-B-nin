<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('commentaires', function (Blueprint $table) {
        $table->id();

        // Contenu concerné
        $table->foreignId('contenu_id')
              ->constrained('contenus')
              ->onDelete('cascade');

        // Auteur du commentaire
        $table->foreignId('user_id')
              ->constrained('users')
              ->onDelete('cascade');

        // Note obligatoire : 1 à 5
        $table->unsignedTinyInteger('note'); // ⭐⭐⭐⭐⭐

        // Texte du commentaire
        $table->text('commentaire');


        // statut de modération
        $table->enum('statut', ['pending', 'validated', 'rejected'])
              ->default('pending');

        $table->index(['statut', 'created_at']);

        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commentaires');
    }
};
