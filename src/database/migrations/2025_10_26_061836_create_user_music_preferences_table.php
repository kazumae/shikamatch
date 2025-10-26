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
        Schema::create('user_music_preferences', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->constrained()
                ->onDelete('cascade');
            $table->foreignId('music_preference_id')
                ->constrained()
                ->onDelete('cascade');
            $table->timestamps();

            $table->unique(['user_id', 'music_preference_id'], 'uk_user_pref');
            $table->index('user_id', 'idx_user_id');
            $table->index('music_preference_id', 'idx_music_preference_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_music_preferences');
    }
};
