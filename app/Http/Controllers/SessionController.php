<?php

namespace App\Http\Controllers;

use App\Models\Session;
use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function index()
    {
        return Session::with('movie', 'room')->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'movie_id' => 'required|exists:movies,id',
            'room_id' => 'required|exists:rooms,id',
            'start_time' => 'required|date',
        ]);

        $session = Session::create($request->all());

        return response()->json($session, 201);
    }

    public function show($id)
    {
        return Session::with('movie', 'room')->findOrFail($id);
    }
}
