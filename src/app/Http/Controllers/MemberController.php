<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class MemberController extends Controller
{
    /**
     * Display a listing of members.
     */
    public function index(Request $request)
    {
        // Get filter parameters from request
        $filters = $request->only(['keyword', 'level', 'parts', 'genres', 'area']);

        // Phase 1: Return mock data
        $members = $this->getMockData($filters);

        // Phase 2: Real data (uncomment when database is ready)
        // $query = User::with(['profile', 'parts', 'genres']);
        //
        // if ($request->filled('keyword')) {
        //     $query->where(function($q) use ($request) {
        //         $q->where('name', 'like', "%{$request->keyword}%")
        //           ->orWhereHas('profile', function($q) use ($request) {
        //             $q->where('self_introduction', 'like', "%{$request->keyword}%");
        //           });
        //     });
        // }
        //
        // if ($request->filled('level')) {
        //     $query->whereHas('profile', function($q) use ($request) {
        //         $q->where('level', $request->level);
        //     });
        // }
        //
        // if ($request->filled('parts')) {
        //     $query->whereHas('parts', function($q) use ($request) {
        //         $q->whereIn('part_name', $request->parts);
        //     });
        // }
        //
        // if ($request->filled('genres')) {
        //     $query->whereHas('genres', function($q) use ($request) {
        //         $q->whereIn('genre_name', $request->genres);
        //     });
        // }
        //
        // if ($request->filled('area')) {
        //     $query->whereHas('profile', function($q) use ($request) {
        //         $q->where('area_prefecture', $request->area);
        //     });
        // }
        //
        // $members = $query->paginate(20);

        return Inertia::render('Members/Index', [
            'members' => $members,
            'filters' => $filters,
            'filterOptions' => $this->getFilterOptions(),
        ]);
    }

    /**
     * Get mock data for members
     */
    private function getMockData($filters = [])
    {
        $mockMembers = [
            [
                'id' => 1,
                'name' => '山田太郎',
                'profile_image' => null,
                'level' => 'shikamini',
                'area' => '東京都',
                'parts' => ['ギター', 'ボーカル'],
                'genres' => ['ロック', 'ポップス'],
                'self_introduction' => '都内でバンド活動をしています。週末を中心に活動できるメンバーを探しています。',
                'created_at' => '2024-01-15',
            ],
            [
                'id' => 2,
                'name' => '佐藤花子',
                'profile_image' => null,
                'level' => 'otoshika',
                'area' => '神奈川県',
                'parts' => ['ベース'],
                'genres' => ['ジャズ', 'R&B'],
                'self_introduction' => 'ベースを始めて1年です。一緒に成長できる仲間を探しています。',
                'created_at' => '2024-01-20',
            ],
            [
                'id' => 3,
                'name' => '鈴木一郎',
                'profile_image' => null,
                'level' => 'shikasession',
                'area' => '大阪府',
                'parts' => ['ドラム'],
                'genres' => ['メタル', 'ロック'],
                'self_introduction' => '10年以上ドラムをやっています。本格的なバンド活動を目指しています。',
                'created_at' => '2024-02-01',
            ],
            [
                'id' => 4,
                'name' => '田中美咲',
                'profile_image' => null,
                'level' => 'shikamini',
                'area' => '千葉県',
                'parts' => ['キーボード', 'ピアノ'],
                'genres' => ['ポップス', 'クラシック'],
                'self_introduction' => 'クラシックピアノの経験を活かしてバンド活動に挑戦したいです。',
                'created_at' => '2024-02-05',
            ],
            [
                'id' => 5,
                'name' => '高橋健太',
                'profile_image' => null,
                'level' => 'otoshika',
                'area' => '埼玉県',
                'parts' => ['ギター'],
                'genres' => ['ブルース', 'ファンク'],
                'self_introduction' => 'ファンクギターに興味があります。グルーヴ重視のバンドを探しています。',
                'created_at' => '2024-02-10',
            ],
            [
                'id' => 6,
                'name' => '伊藤さくら',
                'profile_image' => null,
                'level' => 'sikacrowds',
                'area' => '愛知県',
                'parts' => ['ボーカル'],
                'genres' => ['R&B', 'ポップス'],
                'self_introduction' => 'プロを目指して活動しています。真剣に音楽に取り組む方を募集中。',
                'created_at' => '2024-02-15',
            ],
            [
                'id' => 7,
                'name' => '渡辺翔',
                'profile_image' => null,
                'level' => 'shikasession',
                'area' => '福岡県',
                'parts' => ['ベース', 'ギター'],
                'genres' => ['ロック', 'メタル'],
                'self_introduction' => 'マルチプレイヤーとして活動中。様々なジャンルに挑戦したいです。',
                'created_at' => '2024-02-20',
            ],
            [
                'id' => 8,
                'name' => '中村真由美',
                'profile_image' => null,
                'level' => 'kojika+',
                'area' => '京都府',
                'parts' => ['ドラム'],
                'genres' => ['ジャズ', 'ブルース'],
                'self_introduction' => 'ジャズドラムに興味があります。セッションから始めたいです。',
                'created_at' => '2024-02-25',
            ],
        ];

        // Apply filters to mock data
        $filteredMembers = $mockMembers;

        if (! empty($filters['keyword'])) {
            $keyword = strtolower($filters['keyword']);
            $filteredMembers = array_filter($filteredMembers, function ($member) use ($keyword) {
                return str_contains(strtolower($member['name']), $keyword) ||
                       str_contains(strtolower($member['self_introduction']), $keyword);
            });
        }

        if (! empty($filters['level'])) {
            $filteredMembers = array_filter($filteredMembers, function ($member) use ($filters) {
                return $member['level'] === $filters['level'];
            });
        }

        if (! empty($filters['parts'])) {
            $filteredMembers = array_filter($filteredMembers, function ($member) use ($filters) {
                return ! empty(array_intersect($member['parts'], $filters['parts']));
            });
        }

        if (! empty($filters['genres'])) {
            $filteredMembers = array_filter($filteredMembers, function ($member) use ($filters) {
                return ! empty(array_intersect($member['genres'], $filters['genres']));
            });
        }

        if (! empty($filters['area'])) {
            $filteredMembers = array_filter($filteredMembers, function ($member) use ($filters) {
                return $member['area'] === $filters['area'];
            });
        }

        // Convert to paginated format
        return [
            'data' => array_values($filteredMembers),
            'current_page' => 1,
            'last_page' => 1,
            'per_page' => 20,
            'total' => count($filteredMembers),
        ];
    }

    /**
     * Get filter options for the search form
     */
    private function getFilterOptions()
    {
        return [
            'levels' => [
                ['value' => 'kojika+', 'label' => 'kojika+'],
                ['value' => 'otoshika', 'label' => 'otoshika'],
                ['value' => 'shikamini', 'label' => 'shikamini'],
                ['value' => 'shikasession', 'label' => 'shikasession'],
                ['value' => 'sikacrowds', 'label' => 'sikacrowds'],
            ],
            'parts' => [
                ['value' => 'ギター', 'label' => 'ギター'],
                ['value' => 'ベース', 'label' => 'ベース'],
                ['value' => 'ドラム', 'label' => 'ドラム'],
                ['value' => 'キーボード', 'label' => 'キーボード'],
                ['value' => 'ボーカル', 'label' => 'ボーカル'],
                ['value' => 'ピアノ', 'label' => 'ピアノ'],
                ['value' => 'その他', 'label' => 'その他'],
            ],
            'genres' => [
                ['value' => 'ロック', 'label' => 'ロック'],
                ['value' => 'ポップス', 'label' => 'ポップス'],
                ['value' => 'ジャズ', 'label' => 'ジャズ'],
                ['value' => 'ブルース', 'label' => 'ブルース'],
                ['value' => 'ファンク', 'label' => 'ファンク'],
                ['value' => 'メタル', 'label' => 'メタル'],
                ['value' => 'クラシック', 'label' => 'クラシック'],
                ['value' => 'R&B', 'label' => 'R&B'],
                ['value' => 'その他', 'label' => 'その他'],
            ],
            'areas' => [
                ['value' => '東京都', 'label' => '東京都'],
                ['value' => '神奈川県', 'label' => '神奈川県'],
                ['value' => '千葉県', 'label' => '千葉県'],
                ['value' => '埼玉県', 'label' => '埼玉県'],
                ['value' => '大阪府', 'label' => '大阪府'],
                ['value' => '愛知県', 'label' => '愛知県'],
                ['value' => '福岡県', 'label' => '福岡県'],
                ['value' => '京都府', 'label' => '京都府'],
                // Add more prefectures as needed
            ],
        ];
    }

    /**
     * Display a single member's details.
     */
    public function show($id)
    {
        // Phase 1: Return mock data for single member
        $member = $this->getMockMemberDetail($id);

        // Phase 2: Real data (uncomment when database is ready)
        // $member = User::with(['profile', 'parts', 'genres'])
        //     ->findOrFail($id);

        return Inertia::render('Members/Show', [
            'member' => $member,
        ]);
    }

    /**
     * Get mock data for a single member
     */
    private function getMockMemberDetail($id)
    {
        $mockData = $this->getMockData();
        $members = $mockData['data'];

        foreach ($members as $member) {
            if ($member['id'] == $id) {
                // Add more detailed information for the detail page
                return array_merge($member, [
                    'music_taste' => '美しいギターソロが印象的な曲が好きです。',
                    'favorite_artists' => 'Eric Clapton, Jimmy Page, Santana',
                    'area_city' => '渋谷区',
                ]);
            }
        }

        // Return default if not found
        return [
            'id' => $id,
            'name' => 'テストユーザー',
            'profile_image' => null,
            'level' => 'shikamini',
            'area' => '東京都',
            'area_city' => '渋谷区',
            'parts' => ['ギター'],
            'genres' => ['ロック'],
            'self_introduction' => 'テスト用のプロフィールです。',
            'music_taste' => 'メロディアスな曲が好きです。',
            'favorite_artists' => 'Various Artists',
            'created_at' => '2024-01-01',
        ];
    }
}
