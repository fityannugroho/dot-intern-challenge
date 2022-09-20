<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Song;
use App\Http\Requests\StoreSongRequest;
use App\Http\Requests\UpdateSongRequest;
use App\Traits\ApiResponser;

class SongController extends Controller
{
    use ApiResponser;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $songs = Song::all();

        return $this->success($songs);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\StoreSongRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSongRequest $request)
    {
        $validated = $request->validated();
        $song = Song::create($validated);

        return $this->success($song, 'Created', 201);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Song $song
     * @return \Illuminate\Http\Response
     */
    public function show(Song $song)
    {
        return $this->success($song);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\UpdateSongRequest $request
     * @param \App\Models\Song $song
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSongRequest $request, Song $song)
    {
        $validated = $request->validated();
        $song->update($validated);

        return $this->success($song, 'Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Song $song
     * @return \Illuminate\Http\Response
     */
    public function destroy(Song $song)
    {
        $song->delete();

        return $this->success(null, 'Deleted');
    }
}
