<?php

use App\Http\Controllers\GameController;
use App\Http\Controllers\StatsController;
use App\Http\Controllers\StudyController;
use Illuminate\Support\Facades\Route;

Route::inertia('/', 'Welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::inertia('dashboard', 'Dashboard')->name('dashboard');
    Route::inertia('leaderboard', 'Leaderboard')->name('leaderboard');
    Route::inertia('learnCodeSmells', 'LearnCodeSmells')->name('learnCodeSmells');

    Route::get('game', [GameController::class, 'index'])->name('game.index');

    Route::get('/game/{deck}', [GameController::class, 'show'])->name('game.show');

    Route::post('gameAttempt', [GameController::class, 'store'])->name('game.store');

    Route::get('stats', [StatsController::class, 'index'])->name('stats.index');

    Route::get('study', [StudyController::class, 'index'])->name('study.index');

});

require __DIR__.'/settings.php';
