<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMediasTable extends Migration
{
    public function up()
    {
        Schema::create('medias', function (Blueprint $table) {
    $table->id();

    $table->foreignId('contenu_id')
          ->constrained('contenus')
          ->cascadeOnDelete()
          ->cascadeOnUpdate();

    $table->foreignId('type_media_id')
          ->constrained('typemedias')
          ->cascadeOnUpdate();

    $table->foreignId('langue_id')
          ->nullable()
          ->constrained('langues')
          ->nullOnDelete();

    $table->string('titre')->nullable()->comment('Titre du média');
    $table->text('description')->nullable();

    $table->string('fichier')->comment('Chemin du fichier dans storage');
    $table->string('extension', 10)->nullable();
    $table->integer('taille')->nullable()->comment('Taille du fichier en KB');

    $table->foreignId('uploaded_by')
          ->constrained('users')
          ->cascadeOnUpdate();

    $table->foreignId('validated_by')
          ->nullable()
          ->constrained('users')
          ->nullOnDelete();

    $table->enum('status', ['pending', 'validated', 'rejected'])
          ->default('pending')
          ->index();

    $table->timestamps();
});

    }

    public function down()
    {
        Schema::dropIfExists('medias');
    }
}
