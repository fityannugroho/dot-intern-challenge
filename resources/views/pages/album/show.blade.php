@extends('pages.app')

@section('content')

<x-wrapper>
    @if (session('error'))
    <x-alert type="danger" message="{{ session('error') }}" />
    @endif

    @if (session('success'))
    <x-alert type="success" message="{{ session('success') }}" />
    @endif

    <h1 class="mb-3">{{ $album->name }} ({{ $album->year }})</h1>

    <div class="d-flex gap-2 flex-wrap">
        <a href="{{ route('songs.create', ['id' => $album]) }}" class="btn btn-primary">Add Song</a>
        <a href="{{ route('albums.edit', $album) }}" class="btn btn-outline-secondary">Edit</a>
        {{-- Trigger modal --}}
        <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">
            Delete
        </button>
    </div>
    <hr>

    {{-- Song List --}}
    <div class="row">
        <div class="col-12">
            <div class="list-group">
                @foreach ($album->songs as $song)
                <a href="{{ route('songs.show', $song->id) }}"
                    class="list-group-item d-flex justify-content-between flex-wrap">
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

{{-- Delete Modal --}}
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Delete Album</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this album and all its songs?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form action="{{ route('albums.destroy', $album) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
