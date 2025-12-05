<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('langues', function (Blueprint $table) {
            $table->id();
            $table->string('code', 10)->unique()->comment('Code court de la langue : fon, yor, fr');
            $table->string('nom')->unique()->comment('Nom complet de la langue');
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true)->index();
            $table->string('icone')->nullable()->comment('Chemin de l’icône SVG ou PNG');
            $table->timestamps();

            $table->index('nom');
        });
    }

    public function down()
    {
        Schema::dropIfExists('langues');
    }
};
