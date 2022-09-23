@extends('pages.app')

@section('content')

<x-wrapper>
    @if (session('error'))
    <x-alert type="danger" message="{{ session('error') }}" />
    @endif

    @if (session('success'))
    <x-alert type="success" message="{{ session('success') }}" />
    @endif

    <div class="d-flex align-items-center justify-content-between mb-3">
        <h1 class="h2">Albums</h1>
        <a href="{{ route('albums.create') }}" class="btn btn-primary">Add Album</a>
    </div>
    <div class="row">
        @if (count($albums))
        @foreach($albums as $album)
        <div class="col-md-4">
            <a class="card mb-3 text-body text-decoration-none shadow-sm" href="{{ route('albums.show', $album->id) }}">
                <div class="card-body">
                    <h5 class="card-title">{{ $album->name }}</h5>
                    <p class="card-text text-muted">{{ $album->year }}</p>
                </div>
            </a>
        </div>
        @endforeach
        @else
        <div class="p-3 border">
            <p class="text-muted text-center">There are no albums</p>
        </div>
        @endif
    </div>
</x-wrapper>

@endsection
