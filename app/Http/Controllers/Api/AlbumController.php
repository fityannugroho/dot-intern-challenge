<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SearchAlbumsRequest;
use App\Models\Album;
use App\Http\Requests\StoreAlbumRequest;
use App\Http\Requests\UpdateAlbumRequest;
use App\Traits\ApiResponser;

class AlbumController extends Controller
{
    use ApiResponser;

    /**
     * Display a listing of the resource.
     *
     * @param \App\Http\Requests\SearchAlbumsRequest $request
     * @return \Illuminate\Http\Response
     */
    public function index(SearchAlbumsRequest $request)
    {
        $validated = $request->validated();
        $albumName = $validated['name'] ?? null;
        $albums = ($albumName)
            ? Album::where('name', 'like', "%$albumName%")->get()
            : Album::all();

        return $this->success($albums);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\StoreAlbumRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAlbumRequest $request)
    {
        $validated = $request->validated();
        $album = Album::create($validated);

        return $this->success($album, 'Created', 201);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Album $album
     * @return \Illuminate\Http\Response
     */
    public function show(Album $album)
    {
        return $this->success($album);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\UpdateAlbumRequest $request
     * @param \App\Models\Album $album
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAlbumRequest $request, Album $album)
    {
        $validated = $request->validated();
        $album->update($validated);

        return $this->success($album, 'Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function destroy(Album $album)
    {
        $album->delete();

        return $this->success(null, 'Deleted');
    }
}
