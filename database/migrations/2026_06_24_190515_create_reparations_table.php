<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reparations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vehicule_id')->constrained('vehicules')->onDelete('cascade');
            $table->date('date');
            $table->string('duree_main_oeuvre', 50);
            $table->text('objet_reparation');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reparations');
    }
};