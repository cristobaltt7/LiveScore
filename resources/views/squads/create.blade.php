@extends('layouts.app')

@section('content')
<div class="container text-white">
  <h2><i class="bi bi-plus-circle"></i> Añadir Jugador</h2>
  
  <form method="POST" action="{{ route('squads.store') }}">
    @csrf
    <input type="hidden" name="team_id" value="{{ $team_id }}">

    <div class="mb-3">
      <label class="form-label">Nombre del Jugador</label>
      <input type="text" name="name" class="form-control" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Posición</label>
      <select name="position" class="form-select" required>
        <option value="GK">Portero (GK)</option>
        <option value="CB">Defensa Central (CB)</option>
        <option value="LB">Lateral Izquierdo (LB)</option>
        <option value="RB">Lateral Derecho (RB)</option>
        <option value="CM">Centrocampista (CM)</option>
        <option value="CAM">Media Punta (CAM)</option>
        <option value="LW">Extremo Izquierdo (LW)</option>
        <option value="RW">Extremo Derecho (RW)</option>
        <option value="ST">Delantero (ST)</option>
      </select>
    </div>

    <div class="mb-3">
      <label class="form-label">Número</label>
      <input type="number" name="number" class="form-control" min="1" max="99">
    </div>

    <button class="btn btn-success"><i class="bi bi-check-circle"></i> Guardar jugador</button>
    <a href="{{ route('football.team', $team_id) }}" class="btn btn-secondary">Volver</a>
  </form>
</div>
@endsection
