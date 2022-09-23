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
                                        {{ $album->name }}
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
                                <th>Year</th>
                                <th>Genre</th>
                                <th>Artist</th>
                                <th>Duration</th>
                                <th>Album</th>
                            </thead>
                            <tbody>
                                @if ($totalSongs)
                                @foreach ($songs as $song)
                                <tr>
                                    <td>
                                        {{ $song->title }}
                                    </td>
                                    <td class="text-right">
                                        {{ $song->year }}
                                    </td>
                                    <td>
                                        {{ $song->genre }}
                                    </td>
                                    <td>
                                        {{ $song->artist }}
                                    </td>
                                    <td>
                                        {{ $song->duration }}
                                    </td>
                                    <td>
                                        {{ $song->album_id }}
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
