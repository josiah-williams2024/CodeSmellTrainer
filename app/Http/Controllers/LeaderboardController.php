<?php

namespace App\Http\Controllers;

use App\Models\Deck;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class LeaderboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $leaderboards = [];

        foreach (Deck::all() as $deck) {
            $leaderboard = DB::table('game_results')
                ->join('users', 'game_results.user_id', '=', 'users.id')
                ->select(
                    'users.name',
                    DB::raw('AVG(game_results.score) as average_score')
                )
                ->where('game_results.deck_id', $deck->id)
                ->groupBy('users.id', 'users.name')
                ->orderByDesc('average_score')
                ->limit(5)
                ->get()
                ->values()
                ->map(function ($player, $index) {
                    return [
                        'rank' => $index + 1,
                        'name' => $player->name,
                        'averageScore' => round($player->average_score, 1),
                    ];
                });

            $leaderboards[] = $leaderboard;
        }

        return Inertia::render('Leaderboard', [
            'leaderboard' => $leaderboards,
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
