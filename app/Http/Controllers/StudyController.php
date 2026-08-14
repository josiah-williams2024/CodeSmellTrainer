<?php

namespace App\Http\Controllers;

use App\Models\CodeSmell;
use Inertia\Inertia;
use Inertia\Response;

class StudyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {

        return Inertia::render('LearnCodeSmells', [
            'codeSmells' => CodeSmell::with('deck')->get(),
        ]);
    }


}
