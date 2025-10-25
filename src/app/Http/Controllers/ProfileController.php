<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class ProfileController extends Controller
{
    /**
     * プロフィール表示画面を表示
     */
    public function show()
    {
        // 現在のユーザー情報（モックデータ）
        $user = $this->getMockUserData();

        return Inertia::render('Profile/Show', [
            'user' => $user,
        ]);
    }

    /**
     * プロフィール編集画面を表示
     */
    public function edit()
    {
        // 現在のユーザー情報（モックデータ）
        $user = $this->getMockUserData();

        return Inertia::render('Profile/Edit', [
            'user' => $user,
        ]);
    }

    /**
     * プロフィールを更新
     */
    public function update(Request $request)
    {
        // バリデーション
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'level' => 'required|in:kojika+,otoshika,shikamini,shikasession,sikacrowds',
            'parts' => 'array',
            'genres' => 'array',
            'music_preferences' => 'array',
            'songs_to_copy' => 'array',
            'favorite_artists' => 'array',
            'self_introduction' => 'nullable|string',
            'band_preference' => 'nullable|string',
            'profile_image' => 'nullable|image|max:2048', // 2MB max
        ]);

        // 実際の実装ではここでDBに保存
        // auth()->user()->update($validated);

        return redirect()->back()->with('message', 'プロフィールを更新しました');
    }

    /**
     * モックユーザーデータを取得
     * 実際の実装では auth()->user() を使用
     */
    private function getMockUserData()
    {
        return [
            'id' => 1,
            'name' => '田中太郎',
            'level' => 'shikamini',
            'parts' => ['ギター', 'ボーカル'],
            'genres' => ['ロック', 'ポップス'],
            'music_preferences' => ['メロディアス', 'グルーヴィー'],
            'songs_to_copy' => ['小さな恋のうた', 'チェリー', '天体観測'],
            'favorite_artists' => ['BUMP OF CHICKEN', 'スピッツ'],
            'self_introduction' => 'ギター歴5年です。主にロックやポップスを演奏しています。週末を中心に活動しています。',
            'band_preference' => '音楽を楽しめる人と一緒にバンドを組みたいです！初心者の方も大歓迎です。',
            'profile_image' => null,
        ];
    }
}
