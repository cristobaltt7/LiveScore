@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

    <div class="container py-4 bg-dark text-white">
        <h2 class="mb-4 text-center">Resultados de La Liga</h2>

        {{-- Filtro de jornada --}}
        <form method="GET" action="{{ route('liga.resultados') }}" class="mb-4">
            <div class="row justify-content-center">
                <div class="col-auto">
                    <select name="jornada" class="form-select form-select-sm w-auto text-center"
                        onchange="this.form.submit()">
                        @for($i = 1; $i <= 38; $i++)
                            <option value="{{ $i }}" {{ ($jornada == $i || (!$jornada && $i == 38)) ? 'selected' : '' }}>
                                Jornada {{ $i }}
                            </option>
                        @endfor
                    </select>
                </div>
            </div>
        </form>

        {{-- Partidos --}}
        <h4 class="text-success mt-4 text-white">Partidos</h4>
        @forelse ($matches as $match)
            <div class="bg-secondary p-3 mb-3 rounded text-center shadow">
                <div class="row align-items-center">
                    <div class="col-4 d-flex align-items-center justify-content-end pe-2">
                        <img src="{{ $match['homeTeam']['crest'] ?? '' }}" alt="escudo local" style="height: 32px;"
                            class="me-2">
                        <strong class="text-white text-end">{{ $match['homeTeam']['name'] }}</strong>
                    </div>
                    <div class="col-4 text-center">
                        <div class="fs-5 fw-bold">
                            {{ $match['score']['fullTime']['home'] ?? '-' }} - {{ $match['score']['fullTime']['away'] ?? '-' }}
                        </div>
                        <small class="text-light">
                            {{ \Carbon\Carbon::parse($match['utcDate'])->locale('es')->isoFormat('D MMM YYYY, HH:mm') }}
                        </small>
                    </div>
                    <div class="col-4 d-flex align-items-center justify-content-start ps-2">
                        <strong class="text-white text-start">{{ $match['awayTeam']['name'] }}</strong>
                        <img src="{{ $match['awayTeam']['crest'] ?? '' }}" alt="escudo visitante" style="height: 32px;"
                            class="ms-2">
                    </div>
                </div>
            </div>
        @empty
            <p>No hay partidos para esta jornada.</p>
        @endforelse

        {{-- Clasificación --}}
        <h4 class="text-success mt-5 text-white">Clasificación actual</h4>
        <div class="table-responsive">
            <table class="table table-dark table-bordered rounded shadow" id="tabla-clasificacion">
                <thead class="table-success text-center">
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
                    </tr>
                </thead>
                <tbody>
                    @foreach ($standings as $team)
                        <tr class="text-center align-middle">
                            <td>{{ $team['position'] }}</td>
                            <td class="d-flex align-items-center justify-content-center">
                                <img src="{{ $team['team']['crest'] ?? '' }}" alt="escudo" style="height: 24px;" class="me-2">
                                {{ $team['team']['name'] }}
                            </td>
                            <td>{{ $team['points'] }}</td>
                            <td>{{ $team['playedGames'] }}</td>
                            <td>{{ $team['won'] }}</td>
                            <td>{{ $team['draw'] }}</td>
                            <td>{{ $team['lost'] }}</td>
                            <td>{{ $team['goalsFor'] }}</td>
                            <td>{{ $team['goalsAgainst'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Goleadores --}}
        <h4 class="text-success mt-5 text-white">⚽ Máximos Goleadores</h4>
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-3">
            @forelse($scorers as $scorer)
                <div class="col">
                    <div class="bg-secondary p-3 rounded d-flex align-items-center shadow">
                        <img src="{{ $scorer['team']['crest'] ?? '' }}" alt="escudo" style="height: 42px;" class="me-3">
                        <div>
                            <strong class="text-white">{{ $scorer['player']['name'] }}</strong><br>
                            <small class="text-light">{{ $scorer['team']['name'] }}</small><br>
                            <span class="fw-bold text-white">{{ $scorer['goals'] }} goles</span>
                        </div>
                    </div>
                </div>
            @empty
                <p>No hay datos de goleadores disponibles.</p>
            @endforelse
        </div>
    </div>


<script src="{{ asset('js/liga.js') }}"></script>

@endsection