@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">


    <div class="container text-white">

        <!-- Título con nombre oficial del club o nombre general -->
        <h2 class="mb-3">{{ $data['officialName'] ?? $data['name'] }}</h2>

        <!-- Escudo del club -->
        <img src="{{ $data['image'] }}" alt="Escudo oficial" style="width:100px;" class="mb-3">

        <!-- Información detallada del club en lista -->
        <ul class="list-group list-group-flush club-info-box">
            <li class="list-group-item"><strong>Nombre oficial:</strong> {{ $data['officialName'] ?? 'Desconocido' }}</li>
            <li class="list-group-item"><strong>Fundado:</strong> {{ $data['foundedOn'] ?? 'Desconocido' }}</li>
            <li class="list-group-item"><strong>Dirección:</strong> {{ $data['addressLine1'] ?? '' }}
                {{ $data['addressLine2'] ?? '' }} {{ $data['addressLine3'] ?? '' }}
            </li>
            <li class="list-group-item"><strong>Teléfono:</strong> {{ $data['tel'] ?? 'No disponible' }}</li>
            <li class="list-group-item"><strong>Fax:</strong> {{ $data['fax'] ?? 'No disponible' }}</li>
            <li class="list-group-item"><strong>Web oficial:</strong> <a href="https://{{ $data['website'] }}"
                    class="text-success" target="_blank">{{ $data['website'] }}</a></li>
            <li class="list-group-item"><strong>Estadio:</strong> {{ $data['stadiumName'] ?? 'Desconocido' }}
                ({{ $data['stadiumSeats'] ?? '??' }} asientos)</li>
            <li class="list-group-item"><strong>Socios:</strong> {{ $data['members'] ?? 'N/D' }}
                ({{ $data['membersDate'] ?? 'Fecha desconocida' }})</li>
            <li class="list-group-item"><strong>Otros deportes:</strong> {{ implode(', ', $data['otherSports'] ?? []) }}
            </li>
            <li class="list-group-item"><strong>Colores:</strong>
                @foreach ($data['colors'] ?? [] as $color)
                    <span
                        style="display:inline-block; width:20px; height:20px; background-color:{{ $color }}; border-radius:50%; margin-right:5px;"
                        title="{{ $color }}"></span>
                @endforeach
            </li>
            <li class="list-group-item"><strong>Balance de fichajes actual:</strong>
                {{ number_format($data['currentTransferRecord'] / 1_000_000, 2) }} M €</li>
            <li class="list-group-item"><strong>Valor total de mercado:</strong>
                {{ number_format($data['currentMarketValue'] / 1_000_000, 2) }} M €</li>
            <li class="list-group-item"><strong>Tamaño plantilla:</strong> {{ $data['squad']['size'] ?? '?' }} jugadores
            </li>
            <li class="list-group-item"><strong>Edad media:</strong> {{ $data['squad']['averageAge'] ?? '?' }} años</li>
            <li class="list-group-item"><strong>Extranjeros:</strong> {{ $data['squad']['foreigners'] ?? '?' }}</li>
            <li class="list-group-item"><strong>Internacionales:</strong> {{ $data['squad']['nationalTeamPlayers'] ?? '?' }}
            </li>
            <li class="list-group-item"><strong>Liga:</strong> {{ $data['league']['name'] ?? 'N/D' }}
                ({{ $data['league']['tier'] ?? '' }})</li>
        </ul>

        <!-- Escudos antiguos del club -->
        <h5 class="mt-4">🛡️ Escudos históricos</h5>
        <div class="d-flex flex-wrap gap-3 mt-2">
            @foreach ($data['historicalCrests'] ?? [] as $crest)
                <img src="{{ $crest }}" alt="Escudo histórico" width="80" height="80" class="rounded border">
            @endforeach
        </div>
        <div class="mt-4">
            <a href="{{ route('favorites') }}" class="btn btn-outline-light">← Volver a equipos favoritos</a>
        </div>

    </div>
@endsection