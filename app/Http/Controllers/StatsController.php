<?php

namespace App\Http\Controllers;

use App\Models\Deck;
use Illuminate\Http\Request;
use Inertia\Inertia;

class StatsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userID = auth()->id();

        $decks = Deck::with(['gameResults' => function ($query) use ($userID) {
            $query->where('user_id', $userID);
        }])->get();

        $stats = $decks->map(function ($deck) {
            return [
                'id' => $deck->id,
                'name' => $deck->name,
                'gamesPlayed' => $deck->gameResults->count(),
                'averageAccuracy' => $deck->gameResults->avg('accuracy'),
                'averageScore' => $deck->gameResults->avg('score'),
                'averageTime' => $deck->gameResults->avg('time_seconds'),
                'totalPlaytime' => $deck->gameResults->sum('time_seconds'),
            ];
        });

        return Inertia::render('Stats', [
            'stats' => $stats,
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
