<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request('search')){

            $url = 'https://www.omdbapi.com/?s='.request('search').'&page=1&apikey='.config('omdb.omdb');
        }else{
            $url = 'https://www.omdbapi.com/?s=batman&page=1&apikey='.config('omdb.omdb');
        }

        $data_search = request()->search;
        $movies_array = Http::get($url)->json()['Search'];
        $movies = collect($movies_array);
        // dump($movies);
        // dd($movies);
            // $movies = json_decode($movies, TRUE);
        // dump($movies);
            return view('movies.index',[
                'movies' => $movies,
                'data_search' => $data_search,
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        DB::beginTransaction();
        try {
            Movie::create([
                'imdbID' => $request->imdbID,
                'poster' => $request->Poster,
                'title' => $request->Title,
                'year' => $request->Year,
                'type' => $request->Type
            ]);
            DB::commit();
            // dd('pass');
            return redirect()->back()->with('success', 'Add Movie to Favourite Successfully.');
        } catch (\Exception $e) {
            dd($e);
            DB::rollback();
            // dd('failed');
            return redirect()->back()->with('failed', 'Cannot Add Movie to Favourite Successfully.');
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function show(Movie $movie)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function edit(Movie $movie)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Movie $movie)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $movie = Movie::find($id);
            $movie->delete();
            DB::commit();
            return redirect()->back()->with('failed', 'Remove Success');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('failed', 'Cannot Remove');
        }
    }

    public function myMovie()
    {
        $movies = Movie::get();
        return view('movies.mymovie',[
            'movies' => $movies,
        ]);
    }
}
