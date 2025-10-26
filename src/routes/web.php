<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// 認証関連
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// トップページ（メンバー一覧へリダイレクト）
Route::get('/', function () {
    return redirect('/members');
});

// メンバー一覧・検索
Route::get('/members', [MemberController::class, 'index'])->name('members.index');

// メンバー詳細
Route::get('/members/{id}', [MemberController::class, 'show'])->name('members.show');

// プロフィール表示
Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');

// プロフィール編集
Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
