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
        Schema::create('exutoires', function (Blueprint $table) {
            $table->double('poid_exutoire');
            $table->foreignId('dechet_id')->constrained();
            $table->foreignId('entreprise_id')->constrained();
            $table->timestamps();

            $table->primary(['entreprise_id', 'dechet_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exutoires');
    }
};
