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
        Schema::create('class_login_links', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('course_class_id')->constrained()->cascadeOnDelete();
            $table->string('key');
            $table->boolean('invalidated')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('class_login_links');
    }
};
