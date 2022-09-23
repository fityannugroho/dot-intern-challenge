@extends('pages.app')

@section('content')

<x-wrapper>
    <h1>{{ $album->name }} ({{ $album->year }})</h1>

    {{-- Edit & Delete Button --}}
    <div class="d-flex gap-2">
        <a href="{{ route('songs.create', ['id' => $album]) }}" class="btn btn-primary">Add Song</a>
        <a href="{{ route('albums.edit', $album) }}" class="btn btn-outline-secondary">Edit</a>
        <form action="{{ route('albums.destroy', $album) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-outline-danger">Delete</button>
        </form>
    </div>
    <hr>

    {{-- Song List --}}
    <div class="row">
        <div class="col-12">
            <div class="list-group">
                @foreach ($album->songs as $song)
                <a href="{{ route('songs.show', $song->id) }}" class="list-group-item d-flex justify-content-between">
                    <div class="">
                        <p class="fs-5 mb-1">{{ $song->title }}</p>
                        <p class="mb-1">{{ $song->artist }}</p>
                    </div>
                    <div class="text-end">
                        <p class="mb-1" title="Duration">{{ date('i:s', $song->duration) }}</p>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </div>
</x-wrapper>

@endsection
