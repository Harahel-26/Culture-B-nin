<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('regions', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('type')->nullable(); // département, commune, village
            $table->text('description')->nullable();
            $table->string('langue_principale')->nullable(); // ex: fon, yor...
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('regions');
    }
};
