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
        Schema::create('projets_termines', function (Blueprint $table) {
            $table->id();
            $table ->string('libelle')->nullable();
            $table ->string('description')->nullable();
            $table ->date('datedebut')->nullable();
            $table ->date('datefin')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projets_termines');
    }
};
