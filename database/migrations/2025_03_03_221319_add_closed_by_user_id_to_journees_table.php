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
        Schema::table('journee', function (Blueprint $table) {
            $table->unsignedBigInteger('closed_by_user_id')->nullable()->after('user_id');
            $table->foreign('closed_by_user_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('journee', function (Blueprint $table) {
            $table->dropForeign(['closed_by_user_id']);
            $table->dropColumn('closed_by_user_id');
        });
    }
};
