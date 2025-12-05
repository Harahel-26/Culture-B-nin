<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('paiements', function (Blueprint $table) {
            $table->id();

            $table->string('reference')->unique(); // référence transaction du provider

            $table->foreignId('user_id')
                  ->constrained()
                  ->onDelete('cascade');

            $table->foreignId('contenu_id')
                  ->constrained()
                  ->onDelete('cascade');

            $table->decimal('montant', 10, 2);
            $table->string('devise', 10)->default('XOF');

            // passerelle utilisée : fedapay ou kkiapay
            $table->enum('gateway', ['fedapay', 'kkiapay'])
                  ->comment('Passerelle de paiement utilisée');

            // statut du paiement
            $table->enum('statut', ['en_attente', 'paye', 'echec', 'annule'])
                  ->default('en_attente');

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
