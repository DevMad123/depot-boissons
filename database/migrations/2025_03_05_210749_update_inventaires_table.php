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
        Schema::table('inventaires', function (Blueprint $table) {
            $table->integer('quantite_ouverture')->after('produit_id');
            $table->integer('quantite_fermeture')->nullable()->after('quantite_ouverture');
            $table->text('commentaire')->nullable()->after('quantite_fermeture');
            $table->dropColumn('quantite_physique');
            $table->dropColumn('date_inventaire');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('inventaires', function (Blueprint $table) {
            $table->dropColumn('quantite_ouverture');
            $table->dropColumn('quantite_fermeture');
            $table->dropColumn('commentaire');

            $table->integer('quantite_physique')->after('produit_id');
            $table->dateTime('date_inventaire');
        });
    }
};
