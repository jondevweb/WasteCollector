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
        Schema::create('collecte_points', function (Blueprint $table) {
            $table->id();
            $table->string('adresse_collecte_point');
            $table->foreignId('entreprise_id')->constrained();
            $table->foreignId('client_id')->constrained();
            $table->boolean('ascenseur_collecte_point');
            $table->boolean('badge_collecte_point');
            $table->string('batiment_collecte_point');
            $table->integer('code_collecte_point');
            $table->longText('commentaire_collecte_point');
            $table->double('hauteur_collecte_point');
            $table->boolean('parking_collecte_point');
            $table->integer('telephone_collecte_point');
            $table->text('creneau_collecte_point');
            $table->integer('departement_collecte_point');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('collecte_points');
    }
};
