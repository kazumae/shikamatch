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
        Schema::create('user_parts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->constrained()
                ->onDelete('cascade');
            $table->foreignId('part_id')
                ->constrained()
                ->onDelete('cascade');
            $table->boolean('is_sub')->default(false);
            $table->timestamps();

            $table->unique(['user_id', 'part_id', 'is_sub'], 'uk_user_part');
            $table->index('user_id', 'idx_user_id');
            $table->index('part_id', 'idx_part_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_parts');
    }
};
