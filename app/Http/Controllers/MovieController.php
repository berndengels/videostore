<?php

namespace App\Http\Controllers;

use App\Http\Requests\MovieRequest;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */

    public function index()
    {
        $data = Movie::paginate(20);
        // bin ich eingeloggt?
        if(Auth::check()) {
            return view('admin.movies.index', compact('data'));
        }
        // oder nicht
        else {
            return view('public.movies.index', compact('data'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param Movie $movie
     * @return Response
     */
    public function show(Movie $movie)
    {
        return view('public.movies.show', compact('movie'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.movies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Movie $movie
     * @return Response
     */
    public function edit(Movie $movie)
    {
        return view('admin.movies.edit', compact('movie'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Movie $movie
     * @return Response
     */
    public function update(Request $request, Movie $movie)
    {
        $movie->update($request->validated());
        return redirect()->route('movie');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Movie $movie
     * @return Response
     */
    public function destroy(Movie $movie)
    {
        $author->delete();
        return redirect()->route('authors');
    }
}
