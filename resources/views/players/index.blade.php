@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

    <div class="container text-white py-4">
        <h2 class="mb-4 text-center"><i class="bi bi-person-fill"></i> Plantilla del Club</h2>

        {{-- Iteración sobre la lista de jugadores --}}
        @forelse ($players as $player)
            @if(is_array($player))
                <div
                    class="mb-3 p-3 bg-dark border border-secondary rounded shadow-sm d-flex align-items-center justify-content-between">
                    <div class="fs-6 fw-semibold">
                        {{ $player['name'] ?? 'Desconocido' }}
                    </div>
                    <a href="{{ route('players.full-profile', ['playerId' => $player['id']]) }}"
                        class="btn btn-outline-light btn-sm">
                        Ver jugador
                    </a>
                </div>
            @endif
        @empty
            <p class="text-center text-muted">No se encontraron jugadores.</p>
        @endforelse

        {{-- Botón de volver --}}
        <div class="text-center mt-5">
            <a href="{{ url()->previous() }}" class="btn btn-outline-light px-4 py-2">
                ← Volver atrás
            </a>
        </div>
    </div>
@endsection