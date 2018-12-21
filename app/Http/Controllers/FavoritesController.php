<?php

namespace App\Http\Controllers;

use App\Question;
use Illuminate\Http\Request;

class FavoritesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Question $question)
    {
        $question->favorities()->attach(Auth()->id());

        return back();
    }

    public function destroy(Question $question)
    {
        $question->favorities()->detach(Auth()->id());

        return back();
    }
}
