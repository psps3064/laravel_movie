@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Movies
                        <form action="{{route('movies.index')}}" method="get">
                            <div class="row">
                                <div class="col">

                                </div>
                                <div class="col">
                                    <input type="text" name="search" id="search" class="form-control float-right" placeholder="search..."
                                    onblur="this.form.submit()" value="{{$data_search}}">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-body">
                        <table class="table table-dark">
                            <thead>
                                <tr>
                                    <th scope="col">imdbID</th>
                                    <th scope="col">Poster</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Year</th>
                                    <th scope="col">Type</th>
                                    <th class="text-center" scope="col">Add to Favourite</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($movies as $movie)
                                    <form action="{{ route('movies.store') }}" method="post">
                                        @csrf
                                        <tr class="">
                                            <input type="hidden" name="imdbID" value="{{ $movie['imdbID'] }}">
                                            <input type="hidden" name="Poster" value="{{ $movie['Poster'] }}">
                                            <input type="hidden" name="Title" value="{{ $movie['Title'] }}">
                                            <input type="hidden" name="Year" value="{{ $movie['Year'] }}">
                                            <input type="hidden" name="Type" value="{{ $movie['Type'] }}">
                                            <td>{{ $movie['imdbID'] }}</td>
                                            <td><img src="{{ $movie['Poster'] }}" width="170" height="250"> </td>
                                            <td>{{ $movie['Title'] }}</td>
                                            <td>{{ $movie['Year'] }}</td>
                                            <td>{{ $movie['Type'] }}</td>
                                            <td class="text-center"><button type="submit" class="btn btn-sm btn-primary"> + </button></td>
                                        </tr>
                                    </form>
                                    {{-- {{$movie->Title}} --}}
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
