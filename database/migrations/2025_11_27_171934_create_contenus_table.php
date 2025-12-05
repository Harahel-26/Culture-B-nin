<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('contenus', function (Blueprint $table) {
    $table->id();

    // Infos principales
    $table->string('titre');
    $table->string('slug')->unique();
    $table->text('description')->nullable();
    $table->longText('contenu_texte')->nullable();
    $table->string('image_couverture')->nullable();

    // Relations
    $table->foreignId('langue_id')->constrained();
    $table->foreignId('region_id')->nullable()->constrained()->nullOnDelete();
    $table->foreignId('typecontenu_id')->constrained();
    $table->foreignId('user_id')->constrained(); // auteur
    $table->foreignId('validated_by')->nullable()->constrained('users')->nullOnDelete();

    // Workflow éditorial
    $table->enum('status', ['draft', 'pending', 'validated', 'rejected'])
        ->default('pending');

    // Visibilité front
    $table->boolean('is_active')->default(true);

    // Premium
    $table->boolean('is_premium')->default(false);
    $table->decimal('prix', 10, 2)->nullable();
    $table->text('extrait_gratuit')->nullable();
    $table->integer('max_vues_gratuites')->default(3);
    $table->integer('vues_gratuites')->default(0);
    $table->integer('vues_total')->default(0);

    // Publication
    $table->timestamp('published_at')->nullable();

    $table->timestamps();
});

    }

    public function down() {
        Schema::dropIfExists('contenus');
    }
};
