<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MusicPreferenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $preferences = [
            'メロディアス',
            'グルーヴィー',
            'エモーショナル',
            'テクニカル',
            'アグレッシブ',
            'メロウ',
            'ファンキー',
            'ヘヴィー',
            'ポップ',
            'アコースティック',
            'エレクトリック',
            'プログレッシブ',
            'オルタナティブ',
            'インディー',
            'クラシカル',
            'モダン',
            'ヴィンテージ',
            'エクスペリメンタル',
            'アンビエント',
            'アップテンポ',
            'ミドルテンポ',
            'スローテンポ',
            'ダンサブル',
            'チルアウト',
            'サイケデリック',
        ];

        foreach ($preferences as $preference) {
            DB::table('music_preferences')->insert([
                'name' => $preference,
                'normalized_name' => $this->normalize($preference),
                'match_count' => rand(0, 50),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    /**
     * Normalize the preference name for matching.
     */
    private function normalize(string $name): string
    {
        // Convert katakana to hiragana
        $normalized = mb_convert_kana($name, 'c', 'UTF-8');
        // Convert to lowercase
        $normalized = mb_strtolower($normalized, 'UTF-8');
        // Remove spaces
        $normalized = str_replace(' ', '', $normalized);

        return $normalized;
    }
}
