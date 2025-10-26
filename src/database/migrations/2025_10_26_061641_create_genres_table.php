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
        Schema::create('genres', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50)->unique();
            $table->integer('display_order');
            $table->timestamps();

            $table->index('display_order', 'idx_display_order');
        });

        // 初期データ投入
        $genres = [
            ['name' => 'ロック', 'display_order' => 1],
            ['name' => 'ポップス', 'display_order' => 2],
            ['name' => 'ジャズ', 'display_order' => 3],
            ['name' => 'ブルース', 'display_order' => 4],
            ['name' => 'ファンク', 'display_order' => 5],
            ['name' => 'メタル', 'display_order' => 6],
            ['name' => 'クラシック', 'display_order' => 7],
            ['name' => 'R&B', 'display_order' => 8],
            ['name' => 'その他', 'display_order' => 9],
        ];

        foreach ($genres as $genre) {
            DB::table('genres')->insert([
                'name' => $genre['name'],
                'display_order' => $genre['display_order'],
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
        Schema::dropIfExists('genres');
    }
};
