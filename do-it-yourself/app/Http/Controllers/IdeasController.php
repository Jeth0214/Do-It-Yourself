<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Ideas;
use Facade\FlareClient\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Session\Session as SessionSession;

class IdeasController extends Controller
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
    public function index()
    {
        //

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $user = auth()->user();
        //dd($user);
        return view('ideas/create', compact('user'));
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
        $data =  $request->validate([
            'caption' => 'required',
            'video' => 'required|mimes:mp4,ogx,oga,ogv,ogg,webm,qt | max:1000000',
            'materials' => 'required',
            'instructions' => 'required'
        ]);

        //dd($request->all());

        $base_image_url = '/public/ideas/videos';
        $now = new \DateTime();
        if ($request->hasFile('video')) {
            if ($request->file('video')->isValid()) {
                $extension = $request->video->extension(); // get image file extension
                $request->video->storeAs($base_image_url, auth()->user()->username . "-" . $now->getTimeStamp() . "." . $extension);
                $url = Storage::url('public/ideas/videos/' . auth()->user()->username . "-" . $now->getTimeStamp() . "." . $extension);
                $request->video = $url;
                // dd($url);
                // $videoArray = ['video' => $url];
            }
        }

        //dd($data);
        auth()->user()->ideas()->create([
            'caption' => $data['caption'],
            'instructions' => $data['instructions'],
            'materials' => $data['materials'],
            'video' => $request->video,
        ]);
        return redirect("/profile/" . auth()->user()->id)->with('success', 'Idea created successfully');;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Ideas $idea)
    {
        //dd($idea);
        $user = auth()->user();
        return view('ideas.show', compact('idea', 'user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Ideas $idea, User $user)
    {
        //
        //$user = auth()->user();
        $this->authorize('update', $user->idea);

        return view('ideas.edit', compact('idea', 'user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, User $user)
    {
        //
        $idea = Ideas::findOrFail($id);
        //dd($idea->video);
        $data =  $request->validate([
            'caption' => 'required',
            'video' => 'mimes:mp4,ogx,oga,ogv,ogg,webm,qt | max:1000000',
            'materials' => 'required',
            'instructions' => 'required'
        ]);

        //dd($request->all());

        $base_image_url = '/public/ideas/videos';
        $now = new \DateTime();
        if ($request->hasFile('video')) {
            if ($request->file('video')->isValid()) {
                $extension = $request->video->extension(); // get image file extension
                $request->video->storeAs($base_image_url, auth()->user()->username . "-" . $now->getTimeStamp() . "." . $extension);
                $url = Storage::url('public/ideas/videos/' . auth()->user()->username . "-" . $now->getTimeStamp() . "." . $extension);
                $data['video'] = $url;
                // dd($url);
                // $videoArray = ['video' => $url];
            }
        } else {
            $data['video'] = $idea->video;
        }

        //dd($data);
        $idea->update([
            'caption' => $data['caption'],
            'instructions' => $data['instructions'],
            'materials' => $data['materials'],
            'video' => $data['video'],
        ]);
        return redirect("/profile/" . auth()->user()->id)->with('success', 'Idea updated successfully');;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ideas $idea, User $user)
    {

        //
        $this->authorize('delete', $user->ideas);
        $idea->delete();
        Storage::delete('public/storage/ideas/videos/' . $idea->video);;
        return redirect("/profile/" . auth()->user()->id)->with('success', 'Idea deleted successfully');
    }

    //     public function getVideo(Video $video)
    // {-
    //     $name = $video->name;
    //     $fileContents = Storage::disk('local')->get("uploads/videos/{$name}");
    //     $response =  Response::make($fileContents, 200);
    //     $response->header('Content-Type', "video/mp4");
    //     return $response;
    //}
}
