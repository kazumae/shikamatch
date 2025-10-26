<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get master data IDs
        $parts = DB::table('parts')->pluck('id')->toArray();
        $genres = DB::table('genres')->pluck('id')->toArray();
        $musicPreferences = DB::table('music_preferences')->pluck('id')->toArray();
        $artists = DB::table('artists')->pluck('id')->toArray();
        $songs = DB::table('songs')->pluck('id')->toArray();

        $levels = ['kojika+', 'otoshika', 'shikamini', 'shikasession', 'sikacrowds'];
        $firstNames = ['太郎', '次郎', '三郎', '花子', '美咲', '翔太', '大輝', '優', '陽菜', '結衣', '蓮', '陽斗', '凛', '葵', 'さくら', '悠人', '颯', '咲', '愛', '陸'];
        $lastNames = ['佐藤', '鈴木', '高橋', '田中', '渡辺', '伊藤', '山本', '中村', '小林', '加藤', '吉田', '山田', '佐々木', '山口', '松本', '井上', '木村', '林', '斎藤', '清水'];

        $selfIntroductions = [
            'ロックバンドでギターを弾いています。ONE OK ROCKやMY FIRST STORYが大好きです！',
            'ベース歴5年。グルーヴを大切にしています。一緒にセッションしましょう！',
            'ドラムを叩くのが生きがいです。パワフルなサウンドが得意です。',
            'ボーカルとして活動中。エモーショナルな歌が歌えます。',
            '週末バンドマンです。音楽仲間を探しています。',
            'J-ROCKからメタルまで幅広く聴きます。技術向上に励んでいます！',
            'アマチュアバンドでキーボード担当。雰囲気作りが得意です。',
            '音楽で人を感動させたい。真剣にバンド活動したいです。',
            '初心者ですが、バンドを組みたいです。よろしくお願いします！',
            'プロ志向のメンバーを探しています。本気で音楽やりたい方！',
            'ライブが大好き！一緒にステージに立ちましょう。',
            'メロディアスなロックが好きです。楽しくバンド活動したいです。',
            'テクニカルなプレイを追求しています。切磋琢磨できる仲間募集！',
            'ポップロックバンドでギター弾いてます。明るい曲が好き。',
            'へヴィメタル好き。激しい音楽で発散したい方、集まれ！',
            '音楽理論も勉強中。成長意欲のある方と一緒にやりたいです。',
            'ファンクやR&Bも好き。グルーヴィーな音楽作りましょう。',
            'ジャズから始めました。幅広いジャンルに挑戦したいです。',
            'アニソンバンドやってます。アニメ好きな方歓迎！',
            'オリジナル曲作りたい。作曲に興味ある方一緒にどうですか。',
        ];

        $bandPreferences = [
            'オリジナル曲でライブ活動したい',
            'コピーバンドで楽しくやりたい',
            'プロを目指して本格的に',
            '週1-2回のペースで練習',
            '趣味程度で気楽に',
            '将来的にはメジャーデビュー目指したい',
            'ライブハウスで定期的に演奏',
            '音源制作に力を入れたい',
            'SNSで発信していきたい',
            '地元で活動したい',
        ];

        // Create 60 users with complete profiles and relationships
        for ($i = 1; $i <= 60; $i++) {
            $firstName = $firstNames[array_rand($firstNames)];
            $lastName = $lastNames[array_rand($lastNames)];
            $name = $lastName.' '.$firstName;

            // Create user
            $userId = DB::table('users')->insertGetId([
                'name' => $name,
                'email' => 'user'.$i.'@example.com',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Create profile
            DB::table('profiles')->insert([
                'user_id' => $userId,
                'level' => $levels[array_rand($levels)],
                'self_introduction' => $selfIntroductions[array_rand($selfIntroductions)],
                'band_preference' => $bandPreferences[array_rand($bandPreferences)],
                'profile_image' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Attach parts (1-3 parts per user)
            $userPartCount = rand(1, 3);
            $selectedParts = (array) array_rand(array_flip($parts), $userPartCount);
            foreach ($selectedParts as $index => $partId) {
                DB::table('user_parts')->insert([
                    'user_id' => $userId,
                    'part_id' => $partId,
                    'is_sub' => $index > 0 ? (rand(0, 100) > 70) : false, // 30% chance for sub parts
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            // Attach genres (2-4 genres per user)
            $userGenreCount = rand(2, 4);
            $selectedGenres = (array) array_rand(array_flip($genres), $userGenreCount);
            foreach ($selectedGenres as $genreId) {
                DB::table('user_genres')->insert([
                    'user_id' => $userId,
                    'genre_id' => $genreId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            // Attach music preferences (2-5 preferences per user)
            $userPrefCount = rand(2, 5);
            $selectedPrefs = (array) array_rand(array_flip($musicPreferences), min($userPrefCount, count($musicPreferences)));
            foreach ($selectedPrefs as $prefId) {
                DB::table('user_music_preferences')->insert([
                    'user_id' => $userId,
                    'music_preference_id' => $prefId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            // Attach songs to copy (3-8 songs per user)
            $userSongCount = rand(3, 8);
            $selectedSongs = (array) array_rand(array_flip($songs), min($userSongCount, count($songs)));
            foreach ($selectedSongs as $songId) {
                DB::table('user_songs_to_copy')->insert([
                    'user_id' => $userId,
                    'song_id' => $songId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            // Attach favorite artists (2-6 artists per user)
            $userArtistCount = rand(2, 6);
            $selectedArtists = (array) array_rand(array_flip($artists), min($userArtistCount, count($artists)));
            foreach ($selectedArtists as $artistId) {
                DB::table('user_favorite_artists')->insert([
                    'user_id' => $userId,
                    'artist_id' => $artistId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
