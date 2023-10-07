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
        Schema::create('justification_pictures', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('justification_id')->constrained();
            $table->string('picture_name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('justification_pictures');
    }
};
