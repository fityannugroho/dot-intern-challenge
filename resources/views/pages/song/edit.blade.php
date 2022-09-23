@extends('pages.app')

@section('content')

<x-wrapper>
    @if (session('success'))
    <x-alert type="success" message="{{ session('success') }}" />
    @endif

    @if (session('error'))
    <x-alert type="danger" message="{{ session('error') }}" />
    @endif

    <h1 class="h2">Edit Song</h1>
    <form action="{{ route('songs.update', $song) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-outline mb-3">
            <label for="title" class="form-label">
                <span>{{ __('Title') }}</span>
                <span class="fw-bold text-danger">*</span>
            </label>
            <input type="text" id="title" class="form-control @error('title') is-invalid @enderror" name="title"
                value="{{ old('title') ?? $song->title }}" required autocomplete="title" autofocus
                placeholder="Song title" />

            @error('title')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="form-outline mb-3">
            <label for="artist" class="form-label">
                <span>{{ __('Artist') }}</span>
                <span class="fw-bold text-danger">*</span>
            </label>
            <input type="text" id="artist" class="form-control @error('artist') is-invalid @enderror" name="artist"
                value="{{ old('artist') ?? $song->artist }}" required autocomplete="artist" autofocus
                placeholder="Song artist" />

            @error('artist')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="form-outline mb-3">
            <label for="genre" class="form-label">
                <span>{{ __('Genre') }}</span>
                <span class="fw-bold text-danger">*</span>
            </label>
            <input type="text" id="genre" class="form-control @error('genre') is-invalid @enderror" name="genre"
                value="{{ old('genre') ?? $song->genre }}" required autocomplete="genre" autofocus
                placeholder="Song genre" />

            @error('genre')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="form-outline mb-3">
            <label for="duration" class="form-label">
                <span>{{ __('Duration') }}</span>
                <span class="fw-bold text-danger">*</span>
            </label>
            <input type="time" id="duration" class="form-control @error('duration') is-invalid @enderror"
                name="duration" value="{{ old('duration') ?? date('H:i:s', $song->duration) }}" autocomplete="duration"
                autofocus placeholder="Song duration" />

            @error('duration')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="form-outline mb-3">
            <label for="year" class="form-label">
                <span>{{ __('Year') }}</span>
                <span class="fw-bold text-danger">*</span>
            </label>
            <input type="text" id="year" class="form-control @error('year') is-invalid @enderror" name="year"
                value="{{ old('year') ?? $song->year }}" required autocomplete="year" autofocus
                placeholder="Song year" />

            @error('year')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="form-outline mb-3">
            <label for="album" class="form-label">
                <span>{{ __('Album') }}</span>
            </label>
            <select name="album_id" id="album" class="form-select @error('album_id') is-invalid @enderror">
                <option value="">Select album</option>
                @foreach ($albums as $album)
                <option value="{{ $album->id }}"
                    {{ old('album_id') == $album->id || $song->album_id == $album->id ? 'selected' : '' }}>
                    {{ $album->name }}
                </option>
                @endforeach
            </select>

            @error('album_id')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary btn-block mb-4">Update</button>
    </form>
</x-wrapper>

@endsection
