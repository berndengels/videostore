<?php

namespace App\Http\Controllers\Api;

use App\Models\Author;
use App\Http\Controllers\Controller;
use App\Http\Requests\ApiAuthorRequest;
use App\Http\Resources\AuthorResource;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ApiAuthorController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $data = Author::all();
        $this->data = AuthorResource::collection($data);
        return $this->getResponse();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $item = Author::find($id);
        // prüfe ob Datensatz gefunden wurde
        if($item) {
            $this->data = new AuthorResource($item);
        }
        // wenn nicht, dann array mit fehlermeldung ausgeben
        else {
            $this->error = 'not found';
        }

//        return response()->json($item);
        return $this->getResponse();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(ApiAuthorRequest $request)
    {
        // validierung läuft schief
        if($request->validator && $request->validator->fails()) {
            $$this->error = $request->validator->errors()]
        } else // alles ok
        {
            $item = Author::create($request->validated());
            $this->data = new AuthorResource($item);
        }

        return $this->getResponse();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(ApiAuthorRequest $request, $id)
    {
        // validierung läuft schief
        if($request->validator && $request->validator->fails()) {
            $$this->error = $request->validator->errors()]
        } // alles ok
        else {
            $item = Author::find($id);
            if($item) {
                $item->update($request->validated());
                $this->data = new AuthorResource($item);
            } else {
                $this->error = 'not found';
            }
        }

        return $this->getResponse();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $item = Author::find($id);
        if($item) {
            $item->delete();
            $this->data = new AuthorResource($item);
        } else {
            $this->error = 'not found';
        }
        return $this->getResponse();
    }
}
