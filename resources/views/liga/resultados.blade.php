@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/styles.css') }}">

<div class="container py-4 bg-dark text-white">
    <h2 class="mb-4 text-center">Resultados de La Liga</h2>

    <form method="GET" action="{{ route('liga.resultados') }}" class="mb-4">
        <div class="row justify-content-center">
            <div class="col-md-3">
                <select name="jornada" class="form-select" onchange="this.form.submit()">
                    <option value="">Todas las jornadas</option>
                    @for($i = 1; $i <= 38; $i++)
                        <option value="{{ $i }}" {{ $jornada == $i ? 'selected' : '' }}>Jornada {{ $i }}</option>
                    @endfor
                </select>
            </div>
        </div>
    </form>

    <h4 class="text-success mt-4">Partidos</h4>
    @forelse ($matches as $match)
        <div class="bg-secondary p-2 mb-2 rounded">
            <strong>{{ $match['homeTeam']['name'] }}</strong> 
            {{ $match['score']['fullTime']['home'] ?? '-' }} - {{ $match['score']['fullTime']['away'] ?? '-' }} 
            <strong>{{ $match['awayTeam']['name'] }}</strong>
            <small class="text-muted ms-3">{{ \Carbon\Carbon::parse($match['utcDate'])->locale('es')->isoFormat('D MMM YYYY, HH:mm') }}</small>
        </div>
    @empty
        <p>No hay partidos para esta jornada.</p>
    @endforelse

    <h4 class="text-success mt-5">Clasificación actual</h4>
    <div class="mb-3">
        <button class="btn btn-outline-light btn-sm" onclick="filtrarTabla('all')">Todos</button>
        <button class="btn btn-outline-light btn-sm" onclick="filtrarTabla('home')">Solo Local</button>
        <button class="btn btn-outline-light btn-sm" onclick="filtrarTabla('away')">Solo Visitante</button>
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-dark table-bordered" id="tabla-clasificacion">
            <thead>
                <tr>
                    <th>Pos</th>
                    <th>Equipo</th>
                    <th>Pts</th>
                    <th>J</th>
                    <th>G</th>
                    <th>E</th>
                    <th>P</th>
                    <th>GF</th>
                    <th>GC</th>
                    <th class="filtro">Tipo</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($standings as $team)
                    <tr data-type="{{ $team['homeAway'] ?? 'all' }}">
                        <td>{{ $team['position'] }}</td>
                        <td>{{ $team['team']['name'] }}</td>
                        <td>{{ $team['points'] }}</td>
                        <td>{{ $team['playedGames'] }}</td>
                        <td>{{ $team['won'] }}</td>
                        <td>{{ $team['draw'] }}</td>
                        <td>{{ $team['lost'] }}</td>
                        <td>{{ $team['goalsFor'] }}</td>
                        <td>{{ $team['goalsAgainst'] }}</td>
                        <td class="filtro">{{ $team['homeAway'] ?? 'N/A' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <h4 class="text-success mt-5">⚽ Máximos Goleadores</h4>
    <ul>
        @forelse($scorers as $scorer)
            <li>
                {{ $scorer['player']['name'] }} ({{ $scorer['team']['name'] }}) - {{ $scorer['goals'] }} goles
            </li>
        @empty
            <p>No hay datos de goleadores disponibles.</p>
        @endforelse
    </ul>
</div>

<script>
function filtrarTabla(tipo) {
    const rows = document.querySelectorAll('#tabla-clasificacion tbody tr');
    rows.forEach(row => {
        if (tipo === 'all' || row.dataset.type === tipo) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
}
</script>
@endsection
