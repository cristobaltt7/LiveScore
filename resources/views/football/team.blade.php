@extends('layouts.app')

@section('content')

  <link rel="stylesheet" href="{{ asset('css/formation.css') }}">


  <div class="container text-white">

    <!-- Encabezado con escudo y nombre del equipo -->
    <h2 class="mb-3"><img src="{{ $team['crest'] }}" alt="" width="40"> {{ $team['name'] }}</h2>

    <!-- Botón para añadir un nuevo jugador -->
    <div class="text-end mb-2">
    <a href="{{ route('squads.create', ['team_id' => $team['id']]) }}" class="btn btn-success">
      <i class="bi bi-plus-circle"></i> Añadir jugador
    </a>
    </div>

    <!-- Campo de fútbol con colocación de jugadores -->
    <div class="field">
    @php
    // Posiciones y coordenadas de los 11 jugadores en el campo
    $positions = ['GK', 'CB', 'CB', 'LB', 'RB', 'CM', 'CM', 'CAM', 'LW', 'RW', 'ST'];
    $coords = [
      'GK' => ['top' => '85%', 'left' => '45%'],
      'CB' => ['top' => '65%', 'left' => '30%'],
      'CB2' => ['top' => '65%', 'left' => '60%'],
      'LB' => ['top' => '70%', 'left' => '10%'],
      'RB' => ['top' => '70%', 'left' => '80%'],
      'CM' => ['top' => '50%', 'left' => '40%'],
      'CM2' => ['top' => '50%', 'left' => '50%'],
      'CAM' => ['top' => '35%', 'left' => '45%'],
      'LW' => ['top' => '20%', 'left' => '10%'],
      'RW' => ['top' => '20%', 'left' => '80%'],
      'ST' => ['top' => '15%', 'left' => '45%'],
    ];
    @endphp

    <!-- Mostrar los primeros 11 jugadores en el campo -->
    @foreach($players->take(11) as $index => $player)
      @php
      $posKey = array_keys($coords)[$index] ?? 'CM';
      $pos = $coords[$posKey];
      @endphp
      <div class="player-dot" style="top: {{ $pos['top'] }}; left: {{ $pos['left'] }};" title="{{ $player->name }}">
      {{ $player->number ?? '' }}
      </div>
    @endforeach
    </div>

    <h4 class="text-white text-center mb-3">Jugadores del equipo</h4>

    <!-- Lista completa de jugadores del equipo -->
    <div class="player-list">
    @forelse ($players as $player)
    <div class="player-card">
      <span><strong>{{ $player->name }}</strong> - {{ $player->position }}</span>

      <!-- Formulario para eliminar al jugador -->
      <form method="POST" action="{{ route('squads.destroy', $player->id) }}"
      onsubmit="return confirm('¿Eliminar jugador?')">
      @csrf @method('DELETE')
      <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
      </form>
    </div>
    @empty
    <div class="alert alert-warning text-dark">No hay jugadores en la plantilla.</div>
    @endforelse
    </div>
  </div>
@endsection