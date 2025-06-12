@extends('layouts.app')

@section('content')

<div class="container">

    <h2>Plantilla del equipo {{ $teamId }}</h2>

    <!-- Botón para añadir un nuevo jugador -->
    <a href="{{ route('squads.create', ['team_id' => $teamId]) }}" class="btn btn-success mb-3">Añadir jugador</a>

    <!-- Mensaje de éxito si existe -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Listado de jugadores -->
    @foreach ($players as $player)
        <div class="card mb-2">
            <div class="card-body d-flex justify-content-between align-items-center">

                <!-- Nombre, posición y número del jugador -->
                <div>
                    <strong>{{ $player->name }}</strong> - {{ $player->position }}
                    @if($player->number)
                        (#{{ $player->number }})
                    @endif
                </div>

                <!-- Botones de editar y eliminar -->
                <div>
                    <a href="{{ route('squads.edit', $player->id) }}" class="btn btn-sm btn-primary">Editar</a>

                    <!-- Formulario para eliminar jugador -->
                    <form action="{{ route('squads.destroy', $player->id) }}" method="POST" class="d-inline">
                        @csrf 
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar jugador?')">Eliminar</button>
                    </form>
                </div>

            </div>
        </div>
    @endforeach

</div>
@endsection
