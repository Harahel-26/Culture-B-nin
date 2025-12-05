<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('regions', function (Blueprint $table) {
            $table->id();
            $table->string('nom')->unique();
            $table->string('type')->nullable(); // département, commune, village...
            $table->text('description')->nullable();

            // Relation avec langue principale (optionnelle)
            $table->foreignId('langue_principale_id')
                  ->nullable()
                  ->constrained('langues')
                  ->nullOnDelete();

            $table->boolean('is_active')->default(true)->index();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('regions');
    }
};
