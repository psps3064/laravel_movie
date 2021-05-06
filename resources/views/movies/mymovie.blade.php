@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Dashboard</div>
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
                                    <form action="{{ route('movies.destroy',$movie['id']) }}" method="POST">
                                        @method('delete')
                                        @csrf
                                        <tr class="">
                                            <input type="hidden" name="id" value="{{ $movie['id'] }}">

                                            <td>{{ $movie['imdbID'] }}</td>
                                            <td><img src="{{ $movie['poster'] }}" width="170" height="250"> </td>
                                            <td>{{ $movie['title'] }}</td>
                                            <td>{{ $movie['year'] }}</td>
                                            <td>{{ $movie['type'] }}</td>
                                            <td class="text-center"><button type="submit" class="btn btn-sm btn-danger"> - </button></td>
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
