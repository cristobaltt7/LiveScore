@extends('layouts.app')

@section('content')
<style>
  .field {
    background: url('/images/football_field.png') center/cover no-repeat;
    width: 100%;
    max-width: 900px;
    height: 500px;
    margin: 0 auto 2rem;
    position: relative;
  }

  .player-dot {
    position: absolute;
    width: 60px;
    height: 60px;
    border-radius: 50%;
    background-color: #00b300aa;
    color: #fff;
    font-weight: bold;
    text-align: center;
    line-height: 60px;
    cursor: pointer;
    border: 2px solid white;
  }

  .player-list {
    max-width: 600px;
    margin: 0 auto;
  }

  .player-card {
    background: #222;
    color: #fff;
    padding: 0.5rem 1rem;
    margin-bottom: 0.5rem;
    border-radius: 8px;
    display: flex;
    justify-content: space-between;
  }
</style>

<div class="container text-white">
  <h2 class="mb-3"><img src="{{ $team['crest'] }}" alt="" width="40"> {{ $team['name'] }}</h2>

  <div class="text-end mb-2">
    <a href="{{ route('squads.create', ['team_id' => $team['id']]) }}" class="btn btn-success">
      <i class="bi bi-plus-circle"></i> Añadir jugador
    </a>
  </div>

  <div class="field">
    @php
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

  <div class="player-list">
    @forelse ($players as $player)
      <div class="player-card">
        <span><strong>{{ $player->name }}</strong> - {{ $player->position }}</span>
        <form method="POST" action="{{ route('squads.destroy', $player->id) }}" onsubmit="return confirm('¿Eliminar jugador?')">
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
