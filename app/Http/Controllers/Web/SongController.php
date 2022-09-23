<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSongRequest;
use App\Models\Song;
use Illuminate\Http\Request;

class SongController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $songs = Song::with('album')->get();

        $data['title'] = 'Songs';
        $data['songs'] = $songs;

        return view('pages.song.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $data['title'] = 'Add New Song';
        $data['albums'] = \App\Models\Album::all();
        $data['albumId'] = $request->get('album');

        return view('pages.song.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreSongRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSongRequest $request)
    {
        $validated = $request->validated();
        $song = Song::create($validated);

        if ($song) {
            return redirect()->route('songs.show', $song);
        }

        return redirect()->route('songs.index')->with('error', 'Something went wrong');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Song  $song
     * @return \Illuminate\Http\Response
     */
    public function show(Song $song)
    {
        $data['title'] = $song->title;
        $data['song'] = $song;

        return view('pages.song.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Song  $song
     * @return \Illuminate\Http\Response
     */
    public function edit(Song $song)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Song  $song
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Song $song)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Song  $song
     * @return \Illuminate\Http\Response
     */
    public function destroy(Song $song)
    {
        if ($song->delete()) {
            return redirect()->route('songs.index')->with('success', 'Song deleted successfully');
        }

        return redirect()->route('songs.index')->with('error', 'Song deleted failed');
    }
}
