@extends('pages.app')

@section('content')
<x-wrapper>
    <div class="row">
        <div class="col-md-12">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <h1>Songs</h1>
                <a href="{{ route('songs.create') }}" class="btn btn-primary">Add Song</a>
            </div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Artist</th>
                        <th>Album</th>
                        <th>Genre</th>
                        <th>Year</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($songs as $song)
                    <tr>
                        <td><a href="{{ route('songs.show', $song) }}">{{ $song->title }}</a></td>
                        <td>{{ $song->artist }}</td>
                        <td>{{ $song->album->name ?? '-' }}</td>
                        <td>{{ $song->genre }}</td>
                        <td>{{ $song->year }}</td>
                        <td class="d-flex gap-1">
                            <a href="{{ route('songs.edit', $song->id) }}"
                                class="btn btn-outline-secondary btn-sm mr-1">Edit</a>
                            <form action="{{ route('songs.destroy', $song->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger btn-sm"
                                    onclick="return confirm('Are you sure to delete this song?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-wrapper>

@endsection
