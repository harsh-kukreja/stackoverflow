<?php

namespace App\Http\Controllers;

use App\Question;
use Illuminate\Http\Request;

class FavoritesController extends Controller
{
    public function store(Question $question)
    {
        //to add a record into bridging table, we use attach method
        $question->favorites()->attach(auth()->id());
        return redirect()->back();
    }

    public function destroy(Question $question)
    {
        $question->favorites()->detach(auth()->id());
        return redirect()->back();
    }
}
