<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('paiements', function (Blueprint $table) {
            $table->id();
            $table->string('reference')->unique();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('contenu_id')->constrained()->onDelete('cascade');

            $table->decimal('montant', 10, 2);
            $table->string('devise')->default('XOF');

            $table->enum('methode', ['mobile_money', 'wave', 'carte', 'paypal'])
                  ->default('mobile_money');

            $table->string('operateur')->nullable();
            $table->string('numero_transaction')->nullable();

            $table->enum('statut', ['en_attente', 'paye', 'echec', 'annule'])
                  ->default('en_attente');

            $table->json('metadata')->nullable();
            $table->timestamp('paye_le')->nullable();
            $table->timestamps();

            $table->index(['user_id', 'contenu_id']);
            $table->index('statut');
        });
    }

    public function down()
    {
        Schema::dropIfExists('paiements');
    }
};
