<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ArtistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $artists = [
            // Japanese Rock/Pop
            'ONE OK ROCK',
            'MY FIRST STORY',
            'UVERworld',
            'RADWIMPS',
            'ASIAN KUNG-FU GENERATION',
            'BUMP OF CHICKEN',
            'amazarashi',
            'KANA-BOON',
            'BLUE ENCOUNT',
            'SiM',
            'MAN WITH A MISSION',
            '10-FEET',
            'WANIMA',
            'back number',
            'Official髭男dism',
            'Mrs. GREEN APPLE',
            'King Gnu',
            'Vaundy',
            'YOASOBI',
            'Ado',
            'Eve',
            '米津玄師',
            'Aimer',
            'LiSA',
            'THE ORAL CIGARETTES',
            'Coldrain',
            'Fear, and Loathing in Las Vegas',
            'Crystal Lake',
            'SHISHAMO',
            'ゲスの極み乙女。',
            'クリープハイプ',
            'Superfly',
            'スピッツ',
            'サカナクション',
            // International Rock
            'The Beatles',
            'Queen',
            'Led Zeppelin',
            'Pink Floyd',
            'Nirvana',
            'Radiohead',
            'Foo Fighters',
            'Red Hot Chili Peppers',
            'Green Day',
            'Linkin Park',
            'Muse',
            'Arctic Monkeys',
            'The Strokes',
            'Oasis',
            'Coldplay',
            'Imagine Dragons',
            // International Metal
            'Metallica',
            'Iron Maiden',
            'Slipknot',
            'System Of A Down',
            'Avenged Sevenfold',
            'Bring Me The Horizon',
            'Architects',
            'Parkway Drive',
            // International Alternative/Indie
            'The Smiths',
            'Blur',
            'The Cure',
            'Sonic Youth',
            'Tame Impala',
            'Mac DeMarco',
            'The 1975',
            // Jazz/Blues
            'Miles Davis',
            'John Coltrane',
            'B.B. King',
            'Eric Clapton',
            'Stevie Ray Vaughan',
        ];

        foreach ($artists as $artist) {
            DB::table('artists')->insert([
                'name' => $artist,
                'normalized_name' => $this->normalize($artist),
                'match_count' => rand(0, 100),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    /**
     * Normalize the artist name for matching.
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
