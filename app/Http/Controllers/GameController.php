<?php

namespace App\Http\Controllers;

use App\Models\GameResult;
use Illuminate\Http\Request;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        // I don't think I want to change the page, let the user select their next action
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
