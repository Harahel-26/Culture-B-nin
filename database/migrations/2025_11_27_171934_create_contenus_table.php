<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('contenus', function (Blueprint $table) {
            $table->id();

            // Informations principales
            $table->string('titre');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->longText('contenu_texte')->nullable();

            // Image de couverture
            $table->string('image_couverture')->nullable();

            // Relations
            $table->foreignId('langue_id')->constrained('langues')->cascadeOnDelete();
            $table->foreignId('region_id')->nullable()->constrained('regions')->nullOnDelete();
            $table->foreignId('typecontenu_id')->constrained('typecontenus')->cascadeOnDelete();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete(); // auteur
            $table->foreignId('validated_by')->nullable()->constrained('users')->nullOnDelete(); // validateur

            // Statut
            $table->enum('status', ['draft', 'pending', 'validated', 'rejected'])->default('pending');

            $table->boolean('is_active')->default(true);

            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('contenus');
    }
};
