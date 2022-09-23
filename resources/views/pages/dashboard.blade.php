@extends('pages.app')

@section('content')

<x-wrapper>
    <h1 class="h3 mb-4">Dashboard</h1>
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h2 class="h4 card-title">Albums</h2>
                    <a href="{{ route('albums.index') }}">See all</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class=" text-primary">
                                <th>Name</th>
                                <th>Year</th>
                            </thead>
                            <tbody>
                                @if ($totalAlbums)
                                @foreach ($albums as $album)
                                <tr>
                                    <td>
                                        <a href="{{ route('albums.show', $album->id) }}">
                                            {{ $album->name }}
                                        </a>
                                    </td>
                                    <td class="text-right">
                                        {{ $album->year }}
                                    </td>
                                </tr>
                                @endforeach
                                @else
                                <tr>
                                    <td colspan="2" class="text-center">
                                        <p class="text-muted">There are no albums</p>
                                    </td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h2 class="h4 card-title">Songs</h2>
                    <a href="{{ route('songs.index') }}">See all</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class=" text-primary">
                                <th>Title</th>
                                <th>Artist</th>
                                <th>Duration</th>
                                <th>Album</th>
                            </thead>
                            <tbody>
                                @if ($totalSongs)
                                @foreach ($songs as $song)
                                <tr>
                                    <td>
                                        <a href="{{ route('songs.show', $song->id) }}">
                                            {{ $song->title }}
                                        </a>
                                    </td>
                                    <td>
                                        {{ $song->artist }}
                                    </td>
                                    <td>
                                        {{ $song->str_duration }}
                                    </td>
                                    <td>
                                        @if ($song->album)
                                        <a href="{{ route('albums.show', $song->album->id) }}">
                                            {{ $song->album->name }}
                                        </a>
                                        @else
                                        <p class="text-muted">No album</p>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                                @else
                                <tr>
                                    <td colspan="6" class="text-center">
                                        <p class="text-muted">There are no songs</p>
                                    </td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-wrapper>

@endsection

@section('page-scripts')



@endsection
