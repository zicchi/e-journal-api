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
        Schema::create('daily_note_media', function (Blueprint $table) {
            $table->id();
            $table->foreignId('daily_note_id')->constrained()->onDelete('cascade');
            $table->enum('type', ['audio', 'image']);
            $table->string('url');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daily_note_media');
    }
};
