<?php

namespace App\Http\Controllers;

use App\Models\Deck;
use App\Models\GameResult;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Game', [
            'decks' => Deck::all(),
        ]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'deck_id' => 'required',
            'score' => 'required',
            'total_questions' => 'required',
            'accuracy' => 'required',
            'time_seconds' => 'required',
        ]);

        $userId = $request->user()->id;

        GameResult::query()->create([
            'user_id' => $userId,
            'deck_id' => $validate['deck_id'],
            'score' => $validate['score'],
            'total_questions' => $validate['total_questions'],
            'accuracy' => $validate['accuracy'],
            'time_seconds' => $validate['time_seconds'],
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Deck $deck): Response
    {
        $deck->load('cards');

        $deck->setRelation(
            'cards',
            $deck->cards->shuffle()->values(),
        );

        $page = match ($deck->id) {
            1 => 'GameDeck/LongMethod',
            2 => 'GameDeck/ClutterDetection',
            3 => 'GameDeck/DuplicationDetection',
            4 => 'GameDeck/NestedConditionals',
            5 => 'GameDeck/LongParameterList',
            6 => 'GameDeck/MagicNumbers',
            default => abort(404),
        };

        return Inertia::render($page, [
            'deck' => $deck,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
