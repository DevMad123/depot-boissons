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
        Schema::create('produits', function (Blueprint $table) {
            
        $table->id();
        $table->string('matriproduit');
        $table->string('libelle');
        $table->unsignedBigInteger('emballage_id'); // Colonne de clé étrangère pour `emballages`
        $table->foreign('emballage_id')->references('id')->on('emballages')->onDelete('cascade'); // Relation clé étrangère
        $table->unsignedBigInteger('typeproduit_id');
        $table->foreign('typeproduit_id')->references('id')->on('typeproduits')->onDelete('cascade');
        $table->unsignedBigInteger('format_id');
        $table->foreign('format_id')->references('id')->on('formats')->onDelete('cascade');
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
       // Schema::dropIfExists('produits');
        Schema::table('produits', function (Blueprint $table) {
            $table->dropForeign(['emballage_id']);
            $table->dropColumn('emballage_id');
        });
    }
};
