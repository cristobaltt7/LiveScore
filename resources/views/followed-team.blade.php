@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

    <div class="container py-5">
        <h1 class="text-white mb-4">Equipos Favoritos</h1>

        {{-- Verifica si el usuario tiene equipos favoritos --}}
        @if (!empty($favorites))
            <div class="mb-3">
                <input type="text" id="searchInput" class="form-control" placeholder="Buscar equipo por nombre...">
            </div>

            <!-- Contenedor donde se muestran todos los equipos favoritos -->
            <div class="row" id="favoritesContainer">

                {{-- Recorre cada equipo favorito --}}
                @foreach($favorites as $id => $info)
                    @php
                        $transfermarktId = $info['transfermarkt_id'] ?? null;
                    @endphp

                    {{-- Solo muestra el equipo si tiene un ID válido de Transfermarkt --}}
                    @if($transfermarktId)
                        <div class="card bg-dark text-white mb-3 team-card-wrapper">
                            <div class="card-body d-flex justify-content-between align-items-center">
                                {{-- Logo + Nombre --}}
                                <div class="d-flex align-items-center">
                                    <img src="{{ $info['logo'] }}" alt="{{ $info['name'] }}" style="width:40px; height:40px;"
                                        class="me-3">
                                    <strong class="team-name fs-5">{{ $info['name'] }}</strong>
                                </div>

                                {{-- Botón para ver equipo --}}
                                <a href="{{ route('club.ver', ['id' => $transfermarktId]) }}" class="btn btn-outline-light">
                                    Ver equipo
                                </a>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        @else
            <p class="text-white">Aún no has marcado ningún equipo como favorito.</p>
        @endif
    </div>

@endsection

@section('scripts')
    <script src="{{ asset('js/favoritos.js') }}"></script>

@endsection