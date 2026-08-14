<?php

namespace App\Http\Controllers;

use App\Models\Deck;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class LeaderboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $period = $request->get('period', 'all');

        $leaderboards = [];

        foreach (Deck::all() as $deck) {
            $leaderboard = DB::table('game_results')
                ->join('users', 'game_results.user_id', '=', 'users.id')
                ->select(
                    'users.name',
                    DB::raw('AVG(game_results.score) as average_score')
                )
                ->where('game_results.deck_id', $deck->id)
                ->when($period === 'daily', function ($query) {
                    $query->whereDate('game_results.created_at', today());
                })
                ->when($period === 'weekly', function ($query) {
                    $query->where('game_results.created_at', '>=', now()->startOfWeek());
                })
                ->groupBy('users.id', 'users.name')
                ->orderByDesc('average_score')
                ->get()
                ->values()
                ->map(function ($player, $index) {
                    return [
                        'rank' => $index + 1,
                        'name' => $player->name,
                        'averageScore' => round($player->average_score, 1),
                    ];
                });

            $leaderboards[] = [
                'deck' => [
                    'id' => $deck->id,
                    'name' => $deck->name,
                ],
                'leaderboard' => $leaderboard,
            ];
        }

        return Inertia::render('Leaderboard', [
            'leaderboards' => $leaderboards,
            'period' => $period,
        ]);
    }

}
