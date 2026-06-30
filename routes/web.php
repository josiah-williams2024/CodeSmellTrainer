<?php

use App\Models\Deck;
use Illuminate\Support\Facades\Route;

Route::inertia('/', 'Welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::inertia('dashboard', 'Dashboard')->name('dashboard');
    Route::inertia('game', 'Game')->name('game');
    Route::inertia('stats', 'Stats')->name('stats');
    Route::inertia('leaderboard', 'Leaderboard')->name('leaderboard');
    Route::inertia('learncodesmells', 'LearnCodeSmells')->name('learncodesmells');
    Route::get('game/deckLongMethod', function () {
        $deck = Deck::query()->with('cards')->findOrFail(1);

        return inertia('GameDeck/LongMethod', [
            'deck' => $deck,
        ]);
    })->name('deckLongMethod');
});

require __DIR__.'/settings.php';
