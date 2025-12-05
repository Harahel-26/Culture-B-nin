<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
       Schema::create('typemedias', function (Blueprint $table) {
    $table->id();
    $table->string('nom')->unique()->comment('image, video, audio');
    $table->timestamps();

    $table->index('nom');
});

    }

    public function down() {
        Schema::dropIfExists('typemedias');
    }
};
