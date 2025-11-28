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

            $table->foreignId('contenu_id')->constrained('contenus')->onDelete('cascade');
            $table->foreignId('type_media_id')->constrained('type_medias');
            $table->foreignId('langue_id')->nullable()->constrained('langues');

            $table->string('titre')->nullable();
            $table->text('description')->nullable();

            $table->string('fichier'); // chemin du média dans storage
            $table->string('extension', 10)->nullable();
            $table->integer('taille')->nullable(); // en KB

            $table->foreignId('upload_par')->constrained('users');
            $table->foreignId('valide_par')->nullable()->constrained('users');

            $table->enum('status', ['pending', 'validated', 'rejected'])->default('pending');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('medias');
    }
}
