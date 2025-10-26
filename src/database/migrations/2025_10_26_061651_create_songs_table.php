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
        Schema::create('songs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('artist')->nullable();
            $table->foreignId('artist_id')
                ->nullable()
                ->constrained('artists')
                ->nullOnDelete();
            $table->string('normalized_title');
            $table->string('normalized_artist')->nullable();
            $table->string('youtube_url', 500)->nullable();
            $table->integer('match_count')->default(0);
            $table->timestamps();

            $table->index('normalized_title', 'idx_normalized_title');
            $table->index('normalized_artist', 'idx_normalized_artist');
            $table->index('match_count', 'idx_match_count');
            $table->index(['title', 'artist'], 'idx_title_artist');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('songs');
    }
};
