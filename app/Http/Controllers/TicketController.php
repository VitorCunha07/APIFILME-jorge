<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Session;
use App\Models\Movie;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    /**
     * Exibir uma lista de todos os ingressos.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Retorna todos os ingressos
        return response()->json(Ticket::with(['session', 'movie'])->get());
    }

    /**
     * Exibir um ingresso específico.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function show(Ticket $ticket)
    {
        // Retorna um ingresso específico com a sessão e o filme associados
        return response()->json($ticket->load(['session', 'movie']));
    }

    /**
     * Criar um novo ingresso.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validação dos dados
        $validated = $request->validate([
            'session_id' => 'required|exists:sessions,id',  // Verifica se a sessão existe
            'movie_id' => 'required|exists:movies,id',      // Verifica se o filme existe
            'seat_number' => 'required|string|max:10',      // Número do assento
            'price' => 'required|numeric|min:0',            // Preço do ingresso
        ]);

        // Criação do ingresso
        $ticket = Ticket::create($validated);

        // Retorna o ingresso recém-criado
        return response()->json($ticket, 201);
    }

    /**
     * Atualizar um ingresso existente.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ticket $ticket)
    {
        // Validação dos dados
        $validated = $request->validate([
            'session_id' => 'sometimes|exists:sessions,id',
            'movie_id' => 'sometimes|exists:movies,id',
            'seat_number' => 'sometimes|string|max:10',
            'price' => 'sometimes|numeric|min:0',
        ]);

        // Atualiza o ingresso com os dados validados
        $ticket->update($validated);

        // Retorna o ingresso atualizado
        return response()->json($ticket);
    }

    /**
     * Remover um ingresso.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ticket $ticket)
    {
        // Deleta o ingresso
        $ticket->delete();

        // Retorna um status de sucesso (no content)
        return response()->json(null, 204);
    }
}
