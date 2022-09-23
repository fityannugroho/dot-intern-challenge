@extends('pages.app')

@section('content')

<x-wrapper>
    <h1>{{ $album->name }} ({{ $album->year }})</h1>
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
                        <p class="fs-5 mb-1">{{ date('i:s', $song->duration) }}</p>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </div>
</x-wrapper>

@endsection
