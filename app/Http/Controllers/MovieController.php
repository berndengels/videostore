<?php

namespace App\Http\Controllers;

use App\Http\Requests\MovieRequest;
use App\Models\Author;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class MovieController extends Controller
{
    protected $authors;

    /**
     * MovieController constructor.
     * @param $authors
     */
    // constructor wird bei jeder Instanzierung als erstes aufgerufen
    // Speichere alle Autorennamen auf die Variable $authors
    public function __construct()
    {
        $this->authors = Author::all()
            ->keyBy('id')
            ->sortBy('name')
            ->map->name
        ;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $data = Movie::paginate(20);
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
        return view('admin.movies.create', ['authors' => $this->authors]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(MovieRequest $request)
    {
        // File-Upload über Input-Feld 'image'
        // und Speichern im Ordner storage/app/public/images
        if ($request->hasFile('image')) {
            $request->image->store('public/images');
        }


        Movie::create($request->validated());
        return redirect()->route('movies');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Movie $movie
     * @return Response
     */
    public function edit(Movie $movie)
    {
        return view('admin.movies.edit', [
            'movie'     => $movie,
            'authors'   => $this->authors]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Movie $movie
     * @return Response
     */
    public function update(MovieRequest $request, Movie $movie)
    {
        $movie->update($request->validated());
        return redirect()->route('movies');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Movie $movie
     * @return Response
     */
    public function destroy(Movie $movie)
    {
        //
    }
}
