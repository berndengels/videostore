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
        $validated = $request->validated();
        // file upload image
        if ($request->hasFile('image')) {
            $validated = $this->setFileName('image', $request);
        }
        Movie::create($validated);
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
            'authors'   => $this->authors
        ]);
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
        $validated = $request->validated();
        // file upload image
        if ($request->hasFile('image')) {
            $validated = $this->setFileName('image', $request);
        }
        $movie->update($validated);
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

    protected function setFileName(string $inputName, MovieRequest $request, string $path = 'public/images') {
        // speicher validierte daten in $validated
        $validated  = $request->validated();
        // gib mir den hash namen der upload-datei
        $hashName   = $request->$inputName->hashName();
        // lade die datei hoch und speicher sie in $path mit dem namen $hashName
        $request->$inputName->storeAs($path, $hashName);
        // überschreibe mein $validated array-element mit dem key $inputName mit meinem hash-name
        $validated[$inputName] = $hashName;

        return $validated;
    }
}
