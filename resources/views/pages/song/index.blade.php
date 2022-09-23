@extends('pages.app')

@section('content')

<x-wrapper>
    @if (session('success'))
    <x-alert type="success" message="{{ session('success') }}" />
    @endif

    @if (session('error'))
    <x-alert type="danger" message="{{ session('error') }}" />
    @endif

    <div class="row">
        <div class="col-md-12">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <h1>Songs</h1>
                <a href="{{ route('songs.create') }}" class="btn btn-primary">Add Song</a>
            </div>
            @if ($songs->count())
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Artist</th>
                            <th>Album</th>
                            <th>Year</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($songs as $song)
                        <tr>
                            <td><a href="{{ route('songs.show', $song) }}">{{ $song->title }}</a></td>
                            <td>{{ $song->artist }}</td>
                            <td>
                                @if ($song->album)
                                <a href="{{ route('albums.show', $song->album) }}">{{ $song->album->name }}</a>
                                @else
                                <span class="text-muted">No Album</span>
                                @endif
                            </td>
                            <td>{{ $song->year }}</td>
                            <td>
                                <div class="d-flex gap-1 flex-fill">
                                    <a href="{{ route('songs.edit', $song->id) }}"
                                        class="btn btn-outline-secondary btn-sm mr-1">Edit</a>
                                    <form action="{{ route('songs.destroy', $song->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger btn-sm"
                                            onclick="return confirm('Are you sure to delete this song?')">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <div class="p-3 border">
                <p class="text-muted text-center">There are no songs</p>
            </div>
            @endif
        </div>
    </div>
</x-wrapper>

@endsection
