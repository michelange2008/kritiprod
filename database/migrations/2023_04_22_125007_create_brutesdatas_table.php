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
            $table->foreignId('source_id')->constrained();
            $table->foreignId('brutetype')->constrained();
            $table->foreignId('nature_id')->constrained();
            $table->foreignId('accessible_id')->constrained();
            $table->text('qualite');
            $table->text('adventices');
            $table->foreignId('format_id')->constrained();
            $table->foreignId('application_id')->constrained();
            $table->timestamps();
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
