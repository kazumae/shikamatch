<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SongSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all artists for reference
        $artists = DB::table('artists')->pluck('id', 'name')->toArray();

        $songs = [
            // ONE OK ROCK
            ['title' => 'The Beginning', 'artist' => 'ONE OK ROCK', 'youtube_url' => 'https://www.youtube.com/watch?v=Hh9yZWeTmVM'],
            ['title' => '完全感覚Dreamer', 'artist' => 'ONE OK ROCK', 'youtube_url' => 'https://www.youtube.com/watch?v=xGbxsiBZGPI'],
            ['title' => 'Stand Out Fit In', 'artist' => 'ONE OK ROCK', 'youtube_url' => 'https://www.youtube.com/watch?v=gDW8tRWoSEI'],
            ['title' => 'Wasted Nights', 'artist' => 'ONE OK ROCK', 'youtube_url' => 'https://www.youtube.com/watch?v=XKBrl45ikn4'],

            // MY FIRST STORY
            ['title' => 'The Ending', 'artist' => 'MY FIRST STORY', 'youtube_url' => 'https://www.youtube.com/watch?v=jE8M_1q7qTg'],
            ['title' => 'REVIVER', 'artist' => 'MY FIRST STORY', 'youtube_url' => 'https://www.youtube.com/watch?v=7HjdDJTMQPI'],
            ['title' => 'Black Rail', 'artist' => 'MY FIRST STORY', 'youtube_url' => 'https://www.youtube.com/watch?v=qXoROxz0SLk'],

            // UVERworld
            ['title' => 'Core Pride', 'artist' => 'UVERworld', 'youtube_url' => 'https://www.youtube.com/watch?v=h7MJjqUv-UE'],
            ['title' => 'ODD FUTURE', 'artist' => 'UVERworld', 'youtube_url' => 'https://www.youtube.com/watch?v=xJJhSNvHnNE'],
            ['title' => 'SHAMROCK', 'artist' => 'UVERworld', 'youtube_url' => 'https://www.youtube.com/watch?v=q8jcuEGLjmg'],

            // RADWIMPS
            ['title' => '前前前世', 'artist' => 'RADWIMPS', 'youtube_url' => 'https://www.youtube.com/watch?v=PDSkFeMVNFs'],
            ['title' => 'スパークル', 'artist' => 'RADWIMPS', 'youtube_url' => 'https://www.youtube.com/watch?v=a2GujJZfXpg'],
            ['title' => 'なんでもないや', 'artist' => 'RADWIMPS', 'youtube_url' => 'https://www.youtube.com/watch?v=s3MU41ea4PE'],

            // ASIAN KUNG-FU GENERATION
            ['title' => 'リライト', 'artist' => 'ASIAN KUNG-FU GENERATION', 'youtube_url' => 'https://www.youtube.com/watch?v=ORe7gt-mY14'],
            ['title' => 'ソラニン', 'artist' => 'ASIAN KUNG-FU GENERATION', 'youtube_url' => 'https://www.youtube.com/watch?v=d6G2kNfLyR8'],
            ['title' => '遥か彼方', 'artist' => 'ASIAN KUNG-FU GENERATION', 'youtube_url' => 'https://www.youtube.com/watch?v=Dx_fKPBPYUI'],

            // BUMP OF CHICKEN
            ['title' => '天体観測', 'artist' => 'BUMP OF CHICKEN', 'youtube_url' => 'https://www.youtube.com/watch?v=YcDUg_c1IYQ'],
            ['title' => 'カルマ', 'artist' => 'BUMP OF CHICKEN', 'youtube_url' => 'https://www.youtube.com/watch?v=8s5_vLFYdRM'],
            ['title' => 'ray', 'artist' => 'BUMP OF CHICKEN', 'youtube_url' => 'https://www.youtube.com/watch?v=OE_WdH_fKEw'],

            // amazarashi
            ['title' => '空に歌えば', 'artist' => 'amazarashi', 'youtube_url' => 'https://www.youtube.com/watch?v=6GdH0SgB6ws'],
            ['title' => 'ナモナキウタ', 'artist' => 'amazarashi', 'youtube_url' => 'https://www.youtube.com/watch?v=7KqHGZE9Bxw'],

            // KANA-BOON
            ['title' => 'シルエット', 'artist' => 'KANA-BOON', 'youtube_url' => 'https://www.youtube.com/watch?v=dlFA0Zq1k2A'],
            ['title' => 'ないものねだり', 'artist' => 'KANA-BOON', 'youtube_url' => 'https://www.youtube.com/watch?v=I9tOF-AqELI'],

            // MAN WITH A MISSION
            ['title' => 'database', 'artist' => 'MAN WITH A MISSION', 'youtube_url' => 'https://www.youtube.com/watch?v=oeEP5kIxjw8'],
            ['title' => 'Raise your flag', 'artist' => 'MAN WITH A MISSION', 'youtube_url' => 'https://www.youtube.com/watch?v=G-UN6uNm1ng'],

            // Official髭男dism
            ['title' => 'Pretender', 'artist' => 'Official髭男dism', 'youtube_url' => 'https://www.youtube.com/watch?v=TQ8WlA2GXbk'],
            ['title' => '宿命', 'artist' => 'Official髭男dism', 'youtube_url' => 'https://www.youtube.com/watch?v=6DsH6P8H_DI'],
            ['title' => 'I LOVE...', 'artist' => 'Official髭男dism', 'youtube_url' => 'https://www.youtube.com/watch?v=bt8wNDvIsh4'],

            // Mrs. GREEN APPLE
            ['title' => 'インフェルノ', 'artist' => 'Mrs. GREEN APPLE', 'youtube_url' => 'https://www.youtube.com/watch?v=7dSA_lurMQ8'],
            ['title' => '青と夏', 'artist' => 'Mrs. GREEN APPLE', 'youtube_url' => 'https://www.youtube.com/watch?v=J0NlEL2vXjE'],

            // King Gnu
            ['title' => '白日', 'artist' => 'King Gnu', 'youtube_url' => 'https://www.youtube.com/watch?v=ony539T074w'],
            ['title' => 'Teenager Forever', 'artist' => 'King Gnu', 'youtube_url' => 'https://www.youtube.com/watch?v=I-K0ItHfINc'],

            // Vaundy
            ['title' => '裸の勇者', 'artist' => 'Vaundy', 'youtube_url' => 'https://www.youtube.com/watch?v=OlL1E94kziI'],
            ['title' => '東京フラッシュ', 'artist' => 'Vaundy', 'youtube_url' => 'https://www.youtube.com/watch?v=3jcCG9R8bBw'],

            // YOASOBI
            ['title' => '夜に駆ける', 'artist' => 'YOASOBI', 'youtube_url' => 'https://www.youtube.com/watch?v=x8VYWazR5mE'],
            ['title' => 'アイドル', 'artist' => 'YOASOBI', 'youtube_url' => 'https://www.youtube.com/watch?v=ZRtdQ81jPUQ'],

            // Ado
            ['title' => 'うっせぇわ', 'artist' => 'Ado', 'youtube_url' => 'https://www.youtube.com/watch?v=Qp3b-RXtz4w'],
            ['title' => '新時代', 'artist' => 'Ado', 'youtube_url' => 'https://www.youtube.com/watch?v=1FliVTcX8bQ'],

            // Eve
            ['title' => 'ドラマツルギー', 'artist' => 'Eve', 'youtube_url' => 'https://www.youtube.com/watch?v=jJzw1h5CR-I'],
            ['title' => '廻廻奇譚', 'artist' => 'Eve', 'youtube_url' => 'https://www.youtube.com/watch?v=j5zAo_sLfVs'],

            // 米津玄師
            ['title' => 'Lemon', 'artist' => '米津玄師', 'youtube_url' => 'https://www.youtube.com/watch?v=SX_ViT4Ra7k'],
            ['title' => 'LOSER', 'artist' => '米津玄師', 'youtube_url' => 'https://www.youtube.com/watch?v=Dx_fKPBPYUI'],
            ['title' => '打上花火', 'artist' => '米津玄師', 'youtube_url' => 'https://www.youtube.com/watch?v=-tKVN2mAKRI'],

            // The Beatles
            ['title' => 'Hey Jude', 'artist' => 'The Beatles', 'youtube_url' => 'https://www.youtube.com/watch?v=A_MjCqQoLLA'],
            ['title' => 'Let It Be', 'artist' => 'The Beatles', 'youtube_url' => 'https://www.youtube.com/watch?v=QDYfEBY9NM4'],
            ['title' => 'Yesterday', 'artist' => 'The Beatles', 'youtube_url' => 'https://www.youtube.com/watch?v=wXTJBr9tt8Q'],

            // Queen
            ['title' => 'Bohemian Rhapsody', 'artist' => 'Queen', 'youtube_url' => 'https://www.youtube.com/watch?v=fJ9rUzIMcZQ'],
            ['title' => 'We Will Rock You', 'artist' => 'Queen', 'youtube_url' => 'https://www.youtube.com/watch?v=-tJYN-eG1zk'],
            ['title' => 'Don\'t Stop Me Now', 'artist' => 'Queen', 'youtube_url' => 'https://www.youtube.com/watch?v=HgzGwKwLmgM'],

            // Led Zeppelin
            ['title' => 'Stairway to Heaven', 'artist' => 'Led Zeppelin', 'youtube_url' => 'https://www.youtube.com/watch?v=QkF3oxziUI4'],
            ['title' => 'Kashmir', 'artist' => 'Led Zeppelin', 'youtube_url' => 'https://www.youtube.com/watch?v=tzVJPgCn-Z8'],

            // Nirvana
            ['title' => 'Smells Like Teen Spirit', 'artist' => 'Nirvana', 'youtube_url' => 'https://www.youtube.com/watch?v=hTWKbfoikeg'],
            ['title' => 'Come As You Are', 'artist' => 'Nirvana', 'youtube_url' => 'https://www.youtube.com/watch?v=vabnZ9-ex7o'],

            // Radiohead
            ['title' => 'Creep', 'artist' => 'Radiohead', 'youtube_url' => 'https://www.youtube.com/watch?v=XFkzRNyygfk'],
            ['title' => 'Karma Police', 'artist' => 'Radiohead', 'youtube_url' => 'https://www.youtube.com/watch?v=1uYWYWPc9HU'],

            // Foo Fighters
            ['title' => 'The Pretender', 'artist' => 'Foo Fighters', 'youtube_url' => 'https://www.youtube.com/watch?v=SBjQ9tuuTJQ'],
            ['title' => 'Everlong', 'artist' => 'Foo Fighters', 'youtube_url' => 'https://www.youtube.com/watch?v=eBG7P-K-r1Y'],

            // Red Hot Chili Peppers
            ['title' => 'Californication', 'artist' => 'Red Hot Chili Peppers', 'youtube_url' => 'https://www.youtube.com/watch?v=YlUKcNNmywk'],
            ['title' => 'Under the Bridge', 'artist' => 'Red Hot Chili Peppers', 'youtube_url' => 'https://www.youtube.com/watch?v=lwlogyj7nFE'],

            // Green Day
            ['title' => 'Boulevard of Broken Dreams', 'artist' => 'Green Day', 'youtube_url' => 'https://www.youtube.com/watch?v=Soa3gO7tL-c'],
            ['title' => 'American Idiot', 'artist' => 'Green Day', 'youtube_url' => 'https://www.youtube.com/watch?v=Ee_uujKuJMI'],

            // Linkin Park
            ['title' => 'In The End', 'artist' => 'Linkin Park', 'youtube_url' => 'https://www.youtube.com/watch?v=eVTXPUF4Oz4'],
            ['title' => 'Numb', 'artist' => 'Linkin Park', 'youtube_url' => 'https://www.youtube.com/watch?v=kXYiU_JCYtU'],

            // Muse
            ['title' => 'Supermassive Black Hole', 'artist' => 'Muse', 'youtube_url' => 'https://www.youtube.com/watch?v=Xsp3_a-PMTw'],
            ['title' => 'Knights of Cydonia', 'artist' => 'Muse', 'youtube_url' => 'https://www.youtube.com/watch?v=Q3Yc3HhSl1Q'],

            // Arctic Monkeys
            ['title' => 'Do I Wanna Know?', 'artist' => 'Arctic Monkeys', 'youtube_url' => 'https://www.youtube.com/watch?v=bpOSxM0rNPM'],
            ['title' => '505', 'artist' => 'Arctic Monkeys', 'youtube_url' => 'https://www.youtube.com/watch?v=qU9mHegkTc4'],

            // Metallica
            ['title' => 'Enter Sandman', 'artist' => 'Metallica', 'youtube_url' => 'https://www.youtube.com/watch?v=CD-E-LDc384'],
            ['title' => 'Master of Puppets', 'artist' => 'Metallica', 'youtube_url' => 'https://www.youtube.com/watch?v=xnKhsTXoKCI'],
            ['title' => 'Nothing Else Matters', 'artist' => 'Metallica', 'youtube_url' => 'https://www.youtube.com/watch?v=tAGnKpE4NCI'],

            // Coldplay
            ['title' => 'Yellow', 'artist' => 'Coldplay', 'youtube_url' => 'https://www.youtube.com/watch?v=yKNxeF4KMsY'],
            ['title' => 'The Scientist', 'artist' => 'Coldplay', 'youtube_url' => 'https://www.youtube.com/watch?v=RB-RcX5DS5A'],

            // Oasis
            ['title' => 'Wonderwall', 'artist' => 'Oasis', 'youtube_url' => 'https://www.youtube.com/watch?v=bx1Bh8ZvH84'],
            ['title' => 'Don\'t Look Back in Anger', 'artist' => 'Oasis', 'youtube_url' => 'https://www.youtube.com/watch?v=cmpRLQZkTb8'],

            // スピッツ
            ['title' => 'チェリー', 'artist' => 'スピッツ', 'youtube_url' => 'https://www.youtube.com/watch?v=NDG6kfw5kcU'],
            ['title' => 'ロビンソン', 'artist' => 'スピッツ', 'youtube_url' => 'https://www.youtube.com/watch?v=jPQMYm8TL6o'],

            // back number
            ['title' => 'クリスマスソング', 'artist' => 'back number', 'youtube_url' => 'https://www.youtube.com/watch?v=ItNjMz3B5lE'],
            ['title' => '高嶺の花子さん', 'artist' => 'back number', 'youtube_url' => 'https://www.youtube.com/watch?v=nR7OPSr28JU'],

            // LiSA
            ['title' => '紅蓮華', 'artist' => 'LiSA', 'youtube_url' => 'https://www.youtube.com/watch?v=CwkzK-F0Y00'],
            ['title' => '炎', 'artist' => 'LiSA', 'youtube_url' => 'https://www.youtube.com/watch?v=4Q9DWOnE37w'],

            // Aimer
            ['title' => '残響散歌', 'artist' => 'Aimer', 'youtube_url' => 'https://www.youtube.com/watch?v=nDlkVNAzZCg'],
            ['title' => 'Brave Shine', 'artist' => 'Aimer', 'youtube_url' => 'https://www.youtube.com/watch?v=byPofX1IEQY'],
        ];

        foreach ($songs as $song) {
            $artistId = $artists[$song['artist']] ?? null;

            DB::table('songs')->insert([
                'title' => $song['title'],
                'artist' => $song['artist'],
                'artist_id' => $artistId,
                'normalized_title' => $this->normalize($song['title']),
                'normalized_artist' => $this->normalize($song['artist']),
                'youtube_url' => $song['youtube_url'] ?? null,
                'match_count' => rand(0, 150),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    /**
     * Normalize text for matching.
     */
    private function normalize(string $text): string
    {
        // Convert katakana to hiragana
        $normalized = mb_convert_kana($text, 'c', 'UTF-8');
        // Convert to lowercase
        $normalized = mb_strtolower($normalized, 'UTF-8');
        // Remove spaces
        $normalized = str_replace(' ', '', $normalized);

        return $normalized;
    }
}
