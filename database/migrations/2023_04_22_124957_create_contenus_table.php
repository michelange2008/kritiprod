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
        Schema::create('contenus', function (Blueprint $table) {
            $table->id();
            $table->foreignId('localisation_id')->constrained();
            $table->foreignId('source_id')->constrained();
            $table->foreignId('soustype_id')->constrained();
            $table->foreignId('periode_id')->constrained();
            $table->foreignId('nature_id')->constrained();
            $table->text('description');
            $table->text('formalisees')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contenus');
    }
};
