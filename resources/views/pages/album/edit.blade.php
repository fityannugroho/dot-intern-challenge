@extends('pages.app')

@section('content')

<x-wrapper>
    <h1>Edit Album</h1>

    <form action="{{ route('albums.update', $album) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-outline mb-3">
            <label for="name" class="form-label">
                <span>{{ __('Name') }}</span>
                <span class="fw-bold text-danger">*</span>
            </label>
            <input type="text" id="name" class="form-control @error('name') is-invalid @enderror" name="name"
                value="{{ old('name', $album->name) }}" required autocomplete="name" autofocus
                placeholder="Album name" />

            @error('name')
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
            <input type="number" id="year" class="form-control @error('year') is-invalid @enderror" name="year"
                value="{{ old('year', $album->year) }}" required autocomplete="year" autofocus
                placeholder="Album year" />

            @error('year')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</x-wrapper>

@endsection
