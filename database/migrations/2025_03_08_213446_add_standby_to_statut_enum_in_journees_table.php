<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('journee', function (Blueprint $table) {
            DB::statement("ALTER TABLE journee MODIFY COLUMN statut ENUM('ouverte', 'fermee', 'standby') DEFAULT 'ouverte'");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('journee', function (Blueprint $table) {
            DB::statement("ALTER TABLE journee MODIFY COLUMN statut ENUM('ouverte', 'fermee') DEFAULT 'ouverte'");
        });
    }
};
