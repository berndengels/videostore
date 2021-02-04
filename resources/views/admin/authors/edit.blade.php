@extends('layouts.default')
@section('title','Edit Todo')
@section('header','Edit Todo')

@section('content')
    <form method="post" action="{{ route('authors.update', ['author' => $author->id]) }}">
        @csrf
        <div class="form-group row">
            <label for="firstname" class="col-md-2 col-form-label">Vorname</label>
            <div class="col-md-10">
                <input
                    type="text"
                    id="firstname"
                    name="firstname"
                    value="{{$author->firstname}}"
                    class="@error('firstname') is-invalid @enderror form-control px-1"
                />

                @error('firstname')
                <span class="d-block invalid-feedback" role="alert">
                    <strong>{{ $errors->first('firstname') }}</strong>
                </span>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <label for="lastname" class="col-md-2 col-form-label">Nachname</label>
            <div class="col-md-10">
                <input
                    type="text"
                    id="lastname"
                    name="lastname"
                    value="{{$author->lastname}}"
                    class="@error('lastname') is-invalid @enderror form-control px-1"
                />

                @error('lastname')
                <span class="d-block invalid-feedback" role="alert">
                    <strong>{{ $errors->first('lastname') }}</strong>
                </span>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-auto float-right">
                <input
                    type="submit"
                    id="submit"
                    name="submit"
                    value="Speichern"
                    role="button"
                    class="btn btn-primary col-md-auto px-5"
                />
            </div>
        </div>
    </form>
@endsection
