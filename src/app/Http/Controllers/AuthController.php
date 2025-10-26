<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class AuthController extends Controller
{
    /**
     * ログイン画面を表示
     */
    public function showLoginForm()
    {
        return Inertia::render('Auth/Login');
    }

    /**
     * ログイン処理
     * （モック実装: 実際にはAuth::attempt()等を使用）
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // 実際の実装では以下を実行
        // if (Auth::attempt($request->only('email', 'password'))) {
        //     $request->session()->regenerate();
        //     return redirect()->intended('/members');
        // }

        // モック実装: 常にログイン成功としてメンバー一覧へ
        return redirect('/members');
    }

    /**
     * ログアウト処理
     */
    public function logout(Request $request)
    {
        // セッションをクリア
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // 実際の実装では以下も実行
        // Auth::logout();

        return redirect('/login');
    }
}
