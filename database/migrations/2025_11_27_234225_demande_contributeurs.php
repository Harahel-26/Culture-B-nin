<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('demande_contributeurs', function (Blueprint $table) {
            $table->id();

            // L'utilisateur qui fait la demande
            $table->foreignId('user_id')
                  ->constrained('users')
                  ->onDelete('cascade');

            // Un petit message
            $table->text('motif')->nullable();

            // Statut de la demande
            $table->enum('status', ['pending', 'approved', 'rejected'])
                  ->default('pending');

            // Admin/Modérateur qui traite la demande
            $table->foreignId('validated_by')
                  ->nullable()
                  ->constrained('users')
                  ->onDelete('set null');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('demande_contributeurs');
    }
};
