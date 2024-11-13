<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\AuthController; // Verifique se este controlador existe

// Rota de autenticação para obter o usuário autenticado
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// **Rotas para Movies (Filmes)**

// Obter todos os filmes
Route::get('movies', [MovieController::class, 'index']);

// Obter um filme específico
Route::get('movies/{movie}', [MovieController::class, 'show']);

// Criar um novo filme (requere autenticação)
Route::middleware('auth:sanctum')->post('movies', [MovieController::class, 'store']);

// Atualizar um filme existente (requere autenticação)
Route::middleware('auth:sanctum')->put('movies/{movie}', [MovieController::class, 'update']);

// Deletar um filme (requere autenticação)
Route::middleware('auth:sanctum')->delete('movies/{movie}', [MovieController::class, 'destroy']);

// **Rotas para Sessions (Sessões)**

// Obter todas as sessões
Route::get('sessions', [SessionController::class, 'index']);

// Obter uma sessão específica
Route::get('sessions/{session}', [SessionController::class, 'show']);

// Criar uma nova sessão (requere autenticação)
Route::middleware('auth:sanctum')->post('sessions', [SessionController::class, 'store']);

// Atualizar uma sessão (requere autenticação)
Route::middleware('auth:sanctum')->put('sessions/{session}', [SessionController::class, 'update']);

// Deletar uma sessão (requere autenticação)
Route::middleware('auth:sanctum')->delete('sessions/{session}', [SessionController::class, 'destroy']);

// **Rotas para Rooms (Salas)**

// Obter todas as salas
Route::get('rooms', [RoomController::class, 'index']);

// Obter uma sala específica
Route::get('rooms/{room}', [RoomController::class, 'show']);

// Criar uma nova sala (requere autenticação)
Route::middleware('auth:sanctum')->post('rooms', [RoomController::class, 'store']);

// Atualizar uma sala existente (requere autenticação)
Route::middleware('auth:sanctum')->put('rooms/{room}', [RoomController::class, 'update']);

// Deletar uma sala (requere autenticação)
Route::middleware('auth:sanctum')->delete('rooms/{room}', [RoomController::class, 'destroy']);

// **Rotas para Tickets (Ingressos)**

// Obter todos os ingressos
Route::get('tickets', [TicketController::class, 'index']);

// Obter um ingresso específico
Route::get('tickets/{ticket}', [TicketController::class, 'show']);

// Criar um novo ingresso (requere autenticação)
Route::middleware('auth:sanctum')->post('tickets', [TicketController::class, 'store']);

// Atualizar um ingresso (requere autenticação)
Route::middleware('auth:sanctum')->put('tickets/{ticket}', [TicketController::class, 'update']);

// Deletar um ingresso (requere autenticação)
Route::middleware('auth:sanctum')->delete('tickets/{ticket}', [TicketController::class, 'destroy']);

// **Autenticação (Login e Registro)**

// Rota para login (obter token)
Route::post('login', [AuthController::class, 'login']);

// Rota para registro de novo usuário
Route::post('register', [AuthController::class, 'register']);
