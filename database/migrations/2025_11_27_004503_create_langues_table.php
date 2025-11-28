<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('langues', function (Blueprint $table) {
            $table->id();
            $table->string('code', 10)->unique(); // fon, yor, dendi, fr …
            $table->string('nom')->unique();      // Nom complet
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('langues');
    }
};
