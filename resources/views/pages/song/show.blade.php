@extends('pages.app')

@section('content')

<x-wrapper>
    @if (session('error'))
    <x-alert type="danger" message="{{ session('error') }}" />
    @endif

    @if (session('success'))
    <x-alert type="success" message="{{ session('success') }}" />
    @endif

    <h1 class="mb-3">{{ $song->title }} ({{ $song->year }})</h1>

    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <tbody>
                <tr>
                    <th scope="row">Artist</th>
                    <td>{{ $song->artist }}</td>
                </tr>
                <tr>
                    <th scope="row">Genre</th>
                    <td>{{ $song->genre }}</td>
                </tr>
                <tr>
                    <th scope="row">Duration</th>
                    <td>{{ $song->duration }}</td>
                </tr>
                <tr>
                    <th scope="row">Year</th>
                    <td>{{ $song->year }}</td>
                </tr>
                <tr>
                    <th scope="row">Album</th>
                    <td>
                        @if ($song->album)
                        <a href="{{ route('albums.show', $song->album) }}">{{ $song->album->name }}</a>
                        @else
                        <span class="text-muted">No Album</span>
                        @endif
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="d-flex gap-1">
        <a href="{{ route('songs.edit', $song) }}" class="btn btn-outline-secondary">Edit</a>
        <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">
            Delete
        </button>
    </div>

</x-wrapper>

{{-- Delete Modal --}}
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Delete Song</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this song?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form action="{{ route('songs.destroy', $song) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
