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
        Schema::create('fournisseurs', function (Blueprint $table) {
            $table->id();
            $table->string('matrifournisseur');
            $table->string('nom');
            $table->string('email')->unique()->nullable();
            $table->string('telephone')->unique()->nullable();
            $table->text('adresse')->nullable();
            $table->decimal('solde', 15, 2)->nullable(); // Solde des dettes
            // $table->unsignedBigInteger('typefournisseur_id');
            // $table->foreign('typefournisseur_id')->references('id')->on('typefournisseurs')->onDelete('cascade');
            $table->string('logo')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fournisseurs');
    }
};
