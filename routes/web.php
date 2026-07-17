<?php

use App\Http\Controllers\StudyController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\StatsController;
use App\Models\Deck;
use Illuminate\Support\Facades\Route;

Route::inertia('/', 'Welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::inertia('dashboard', 'Dashboard')->name('dashboard');
    Route::inertia('game', 'Game')->name('game');
    Route::inertia('leaderboard', 'Leaderboard')->name('leaderboard');
    Route::inertia('learncodesmells', 'LearnCodeSmells')->name('learncodesmells');
    Route::get('game/deckLongMethod', function () {
        $deck = Deck::query()->with('cards')->findOrFail(1);

        return inertia('GameDeck/LongMethod', [
            'deck' => $deck,
        ]);
    })->name('deckLongMethod');

    Route::get('game/deckClutter', function () {
        $deck = Deck::query()->with('cards')->findOrFail(2);

        return inertia('GameDeck/ClutterDetection', [
            'deck' => $deck,
        ]);
    })->name('deckClutter');

    Route::get('game/deckDuplication', function () {
        $deck = Deck::query()->with('cards')->findOrFail(3);

        return inertia('GameDeck/DuplicationDetection', [
            'deck' => $deck,
        ]);
    })->name('deckDuplication');

    Route::post('gameAttempt', [GameController::class, 'store'])->name('game.store');

    Route::get('stats', [StatsController::class, 'index'])->name('stats.index');

    Route::get('study', [StudyController::class, 'index'])->name('study.index');

});

require __DIR__.'/settings.php';
