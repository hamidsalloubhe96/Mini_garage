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
        
    Schema::create('vehicules', function (Blueprint $table) {
            $table->id();
            $table->string('immatriculation', 20)->unique();
            $table->string('marque', 50);
            $table->string('modele', 50);
            $table->string('couleur', 30);
            $table->integer('annee');
            $table->integer('kilometrage');
            $table->string('carrosserie', 50);
            $table->string('energie', 20);
            $table->string('boite', 20);
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('vehicules');
    }
};
