<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('ventes', function (Blueprint $table) {
            $table->unsignedBigInteger('journee_id')->after('id')->default(1);
            $table->foreign('journee_id')->references('id')->on('journee')->onDelete('cascade');
        });

        Schema::table('approvisionnements', function (Blueprint $table) {
            $table->unsignedBigInteger('journee_id')->after('id')->default(1);
            $table->foreign('journee_id')->references('id')->on('journee')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ventes', function (Blueprint $table) {
            $table->dropForeign(['journee_id']);
            $table->dropColumn('journee_id');
        });

        Schema::table('approvisionnements', function (Blueprint $table) {
            $table->dropForeign(['journee_id']);
            $table->dropColumn('journee_id');
        });
    }
};
