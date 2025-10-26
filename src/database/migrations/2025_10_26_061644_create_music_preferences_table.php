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
        Schema::create('music_preferences', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100)->unique();
            $table->string('normalized_name', 100);
            $table->integer('match_count')->default(0);
            $table->timestamps();

            $table->index('normalized_name', 'idx_normalized_name');
            $table->index('match_count', 'idx_match_count');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('music_preferences');
    }
};
