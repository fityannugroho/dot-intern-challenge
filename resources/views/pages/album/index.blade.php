@extends('pages.app')

@section('content')

<x-wrapper>
    <div class="d-flex align-items-center justify-content-between mb-3">
        <h1 class="h2">Albums</h1>
        <a href="{{ route('albums.create') }}" class="btn btn-primary">Add</a>
    </div>
    <div class="row">
        @foreach($albums as $album)
        <div class="col-md-4">
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">{{ $album->name }}</h5>
                    <p class="card-text text-muted">{{ $album->year }}</p>
                    <a href="{{ route('albums.show', $album->id) }}" class="btn btn-primary">View Album</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</x-wrapper>

@endsection
