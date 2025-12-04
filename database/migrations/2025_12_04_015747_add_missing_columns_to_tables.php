<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Ajouter à typecontenus
        if (Schema::hasTable('typecontenus')) {
            Schema::table('typecontenus', function (Blueprint $table) {
                if (!Schema::hasColumn('typecontenus', 'slug')) {
                    $table->string('slug')->unique()->nullable()->after('nom');
                }
                if (!Schema::hasColumn('typecontenus', 'is_active')) {
                    $table->boolean('is_active')->default(true)->after('slug');
                }
                if (!Schema::hasColumn('typecontenus', 'icone')) {
                    $table->string('icone')->nullable()->after('is_active');
                }
                if (!Schema::hasColumn('typecontenus', 'description')) {
                    $table->text('description')->nullable()->after('icone');
                }
            });
        }

        // Ajouter à langues
        if (Schema::hasTable('langues')) {
            Schema::table('langues', function (Blueprint $table) {
                if (!Schema::hasColumn('langues', 'is_active')) {
                    $table->boolean('is_active')->default(true)->after('code');
                }
                if (!Schema::hasColumn('langues', 'icone')) {
                    $table->string('icone')->nullable()->after('is_active');
                }
            });
        }

        // Ajouter à regions
        if (Schema::hasTable('regions')) {
            Schema::table('regions', function (Blueprint $table) {
                if (!Schema::hasColumn('regions', 'slug')) {
                    $table->string('slug')->unique()->nullable()->after('nom');
                }
                if (!Schema::hasColumn('regions', 'is_active')) {
                    $table->boolean('is_active')->default(true)->after('slug');
                }
            });
        }
    }

    public function down(): void
    {
        
    }
};
