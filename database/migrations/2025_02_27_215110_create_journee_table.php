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
        Schema::create('journee', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->dateTime('date_ouverture');
            $table->dateTime('date_fermeture')->nullable();
            $table->enum('statut', ['ouverte', 'fermee'])->default('ouverte');

            $table->decimal('total_entrees', 10, 2)->default(0);
            $table->decimal('total_sorties', 10, 2)->default(0);
            $table->decimal('solde_financier', 10, 2)->default(0);

            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('journee');
    }
};
