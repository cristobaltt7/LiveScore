@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

    <div class="container text-white">
        {{-- Estadísticas de jugadores --}}
        <h2 class="mb-4">Estadísticas de jugadores</h2>
        <div id="teamsContainer" class="row row-cols-1 row-cols-md-3 g-4">
            {{-- Aquí se cargarán dinámicamente los equipos con JS --}}
        </div>
    </div>

@endsection

@section('scripts')
    <script src="{{ asset('js/estadisticas-jugadores.js') }}"></script>

@endsection