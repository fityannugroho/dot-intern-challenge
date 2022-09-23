<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAlbumRequest;
use App\Http\Requests\UpdateAlbumRequest;
use App\Models\Album;
use Illuminate\Http\Request;

class AlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $albums = Album::all();

        $data['title'] = 'Albums';
        $data['albums'] = $albums;

        return view('pages.album.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title'] = 'Add New Album';

        return view('pages.album.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreAlbumRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAlbumRequest $request)
    {
        $validated = $request->validated();
        $album = Album::create($validated);

        if ($album) {
            return redirect()->route('albums.index')->with('success', 'Album created successfully');
        }

        return redirect()->back()->with('error', 'Album created failed');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function show(Album $album)
    {
        $data['title'] = $album->name;
        $data['album'] = $album;

        return view('pages.album.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function edit(Album $album)
    {
        $data['title'] = 'Edit Album';
        $data['album'] = $album;

        return view('pages.album.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateAlbumRequest $request
     * @param  \App\Models\Album $album
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAlbumRequest $request, Album $album)
    {
        $validated = $request->validated();

        if ($album->update($validated)) {
            return redirect()->route('albums.show', $album)->with('success', 'Album updated successfully');
        }

        return redirect()->back()->with('error', 'Album updated failed');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function destroy(Album $album)
    {
        if ($album->delete()) {
            return redirect()->route('albums.index')->with('success', 'Album deleted successfully');
        }

        return redirect()->back()->with('error', 'Album deleted failed');
    }
}
