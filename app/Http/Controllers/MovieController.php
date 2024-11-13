<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function index()
    {
        return Movie::all();
    }

    public function show($id)
    {
        return Movie::findOrFail($id);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'image_url' => 'nullable|url',
        ]);

        $movie = Movie::create($request->all());

        return response()->json($movie, 201);
    }

    public function update(Request $request, $id)
    {
        $movie = Movie::findOrFail($id);
        $movie->update($request->all());

        return response()->json($movie);
    }

    public function destroy($id)
    {
        Movie::destroy($id);

        return response()->json(null, 204);
    }
}
