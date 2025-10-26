<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('parts', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50)->unique();
            $table->integer('display_order');
            $table->timestamps();

            $table->index('display_order', 'idx_display_order');
        });

        // 初期データ投入
        $parts = [
            ['name' => 'ギター', 'display_order' => 1],
            ['name' => 'ベース', 'display_order' => 2],
            ['name' => 'ドラム', 'display_order' => 3],
            ['name' => 'キーボード', 'display_order' => 4],
            ['name' => 'ボーカル', 'display_order' => 5],
            ['name' => 'ピアノ', 'display_order' => 6],
            ['name' => 'その他', 'display_order' => 7],
        ];

        foreach ($parts as $part) {
            DB::table('parts')->insert([
                'name' => $part['name'],
                'display_order' => $part['display_order'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parts');
    }
};
