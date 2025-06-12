@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/styles.css') }}">

<div class="container text-white py-4">
    @if(!empty($error))
        <div class="alert alert-warning text-center">
            {{ $error }}
        </div>
    @else
        {{-- Cabecera del jugador --}}
        <div class="card bg-dark text-white border-light shadow-sm mb-4">
            <div class="card-body text-center">
                <h2 class="mb-3">{{ $profile['name'] ?? 'Nombre desconocido' }}</h2>
                @if(!empty($profile['imageUrl']))
                    <img src="{{ $profile['imageUrl'] }}" class="rounded shadow-sm mb-3" style="max-width: 180px;">
                @endif
                <p class="mb-1"><strong>Edad:</strong> {{ $profile['age'] ?? 'N/D' }} años</p>
                <p class="mb-1"><strong>Nacionalidad:</strong> {{ implode(', ', $profile['citizenship'] ?? []) }}</p>
                <p class="mb-1"><strong>Posición principal:</strong> {{ $profile['position']['main'] ?? 'N/D' }}</p>
                <p class="mb-1"><strong>Otras posiciones:</strong> {{ implode(', ', $profile['position']['other'] ?? []) }}</p>
                <p class="mb-1"><strong>Valor de mercado:</strong> 
                    {{ isset($profile['marketValue']) ? number_format($profile['marketValue'] / 1_000_000, 2) . ' M €' : 'N/D' }}
                </p>
            </div>
        </div>

        {{-- Descripción --}}
        <div class="bg-secondary p-3 rounded mb-4 shadow-sm">
            <strong>Descripción:</strong>
            <p class="mb-0">{{ $profile['description'] ?? 'No disponible.' }}</p>
        </div>

        {{-- Estadísticas --}}
        <h4 class="text-success mt-4 mb-3"><i class="bi bi-bar-chart"></i> Estadísticas</h4>
        <ul class="list-group mb-4">
            @forelse ($stats['stats'] ?? [] as $stat)
                <li class="list-group-item bg-dark text-white">
                    <strong>{{ $stat['competitionName'] ?? 'Competición desconocida' }}</strong> ({{ $stat['seasonId'] ?? '¿?' }}) — 
                    Partidos: {{ $stat['appearances'] ?? 0 }},
                    Goles: {{ $stat['goals'] ?? 0 }},
                    Asistencias: {{ $stat['assists'] ?? 0 }},
                    Minutos: {{ $stat['minutesPlayed'] ?? 0 }}
                </li>
            @empty
                <li class="list-group-item bg-dark text-white">No hay estadísticas disponibles.</li>
            @endforelse
        </ul>

        {{-- Lesiones --}}
        <h4 class="text-danger mt-4 mb-3"><i class="bi bi-emoji-dizzy"></i> Lesiones</h4>
        <ul class="list-group mb-4">
            @forelse ($injuries['injuries'] ?? [] as $injury)
                <li class="list-group-item bg-dark text-white">
                    {{ $injury['injury'] ?? 'Lesión desconocida' }}
                    ({{ $injury['fromDate'] ?? '¿?' }} - {{ $injury['untilDate'] ?? '¿?' }})
                    @if(isset($injury['gamesMissed']))
                        – <strong>{{ $injury['gamesMissed'] }}</strong> partidos perdidos
                    @endif
                </li>
            @empty
                <li class="list-group-item bg-dark text-white">Sin lesiones registradas.</li>
            @endforelse
        </ul>

        {{-- Logros --}}
        <h4 class="text-warning mt-4 mb-3"><i class="bi bi-trophy"></i> Logros</h4>
        <ul class="list-group mb-4">
            @forelse ($achievements['achievements'] ?? [] as $achievement)
                <li class="list-group-item bg-dark text-white">
                    {{ $achievement['title'] ?? 'Título desconocido' }} ({{ $achievement['count'] ?? 0 }} veces)
                </li>
            @empty
                <li class="list-group-item bg-dark text-white">No hay logros disponibles.</li>
            @endforelse
        </ul>

        {{-- Botón volver --}}
        <div class="text-center mt-5">
            @if(isset($profile['currentTeamId']))
                <a href="{{ route('club.players', ['id' => $profile['currentTeamId']]) }}" class="btn btn-outline-light">
                    ← Ver Equipo
                </a>
            @else
                <a href="{{ url()->previous() }}" class="btn btn-outline-light">
                    ← Volver
                </a>
            @endif
        </div>
    @endif
</div>
@endsection
