<?php

namespace App\Http\Controllers;

use App\Models\Ideas;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $ideas = Ideas::orderBy('created_at', 'desc')->get();

        foreach ($ideas as $idea) {

            $idea['saves'] = (auth()->user()) ? auth()->user()->savingIdeas->contains($idea->id) : false;
        }

        //dd($saves);
        return view('home', compact('ideas'));
    }

    public function ideas()
    {
        $ideas = auth()->user()->savingIdeas()->pluck('ideas.id');
        //dd($ideas);
        $saves = Ideas::whereIn('id', $ideas)->with('user')->latest()->paginate(5);

        //dd($saves);
        return view('home/saved-ideas', compact('saves'));
    }
}
