<?php

namespace App\Http\Controllers;

use App\Models\Ideas;
use App\Models\User;
use Illuminate\Http\Request;

class SavesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    //
    public function store(Ideas $idea, User $user)
    {
        return auth()->user()->savingIdeas()->toggle($idea->id);
    }
}
