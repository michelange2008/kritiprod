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
        Schema::create('brutesdatas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('contenu_id')->constrained();
            $table->foreignId('brutetype_id')->constrained();
            $table->text('naturedatas');
            $table->foreignId('accessible_id')->constrained();
            $table->text('qualite')->nullable();
            $table->boolean('adventices')->nullable();
            $table->unsignedBigInteger('format_id')->nullable();
            $table->foreign('format_id')->references('id')->on('formats');
            $table->foreignId('application_id')->constrained();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('brutesdatas');
    }
};
