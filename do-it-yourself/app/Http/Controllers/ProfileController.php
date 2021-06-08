<?php

namespace App\Http\Controllers;

use App\Models\Ideas;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user)
    {
        //
        $ideas = Ideas::whereIn('user_id', [$user->id])->latest()->simplePaginate(6);
        $saves = auth()->user()->savingIdeas()->pluck('ideas.id');
        //dd($saves);
        $saveIdeas = Ideas::whereIn('id', $saves)->with('user')->latest()->simplePaginate(6);
        // dd($ideas);
        //dd($saveIdeas);
        return view('profile.index', compact('user', 'ideas', 'saveIdeas'));
    }

    public function saved(User $user)
    {

        $saves = auth()->user()->savingIdeas()->pluck('ideas.id');
        //dd($saves);
        $saveIdeas = Ideas::whereIn('id', $saves)->with('user')->latest()->simplePaginate(6);
        // dd($ideas);
        //dd($saveIdeas);
        return view('profile.saved', compact('user', 'saveIdeas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //

        $this->authorize('update', $user->profile);
        return view('profile.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        //dd($user);
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'url' => 'url',
            'profile_img' => 'image|max:10000',
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255',],
            'email' => ['required', 'string', 'email::rfc,dns', 'max:255',],
            'password' => ['required', 'string', 'min:8'],
        ]);



        $profileImage = "";
        $base_image_url = '/public/profile/images';
        $now = new \DateTime();
        if ($request->hasFile('profile_img')) {
            if ($request->file('profile_img')->isValid()) {
                $extension = $request->profile_img->extension(); // get image file extension
                $request->profile_img->storeAs($base_image_url, $user->username . "-" . $now->getTimeStamp() . "." . $extension);
                $url = Storage::url('public/profile/images/' . $user->username . "-" . $now->getTimeStamp() . "." . $extension);

                $profileImage = $url;
            }
        } else {
            $profileImage = $user->profile_img;
        }



        auth()->user()->profile()->update([
            'title' => $request->title,
            'description' => $request->description,
            'url' => $request->url,
        ]);

        auth()->user()->update([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'profile_img' => $profileImage,
            'password' => Hash::make($request->password),

        ]);

        return redirect("/profile/$user->id");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
