<?php


namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    /**
     * Exibir uma lista de todas as salas.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Retorna todas as salas, você pode adicionar a paginação se necessário
        return response()->json(Room::all());
    }

    /**
     * Exibir uma sala específica.
     *
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function show(Room $room)
    {
        // Retorna uma sala específica
        return response()->json($room);
    }

    /**
     * Criar uma nova sala.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validação dos dados enviados
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'capacity' => 'required|integer|min:1',
        ]);

        // Criação da sala
        $room = Room::create($validated);

        return response()->json($room, 201);
    }

    /**
     * Atualizar uma sala existente.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Room $room)
    {
        // Validação dos dados enviados
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'capacity' => 'required|integer|min:1',
        ]);

        // Atualiza a sala com os novos dados
        $room->update($validated);

        return response()->json($room);
    }

    /**
     * Remover uma sala.
     *
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function destroy(Room $room)
    {
        // Exclui a sala
        $room->delete();

        return response()->json(null, 204);
    }
}
