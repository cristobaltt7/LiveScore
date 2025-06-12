@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

    <div class="container text-white">
        <h2>{{ $data['name'] }}</h2>
        <img src="{{ $data['imageUrl'] }}" alt="{{ $data['name'] }}" class="mb-3" width="120">

        {{-- Lista con los datos del jugador --}}
        <ul class="list-group bg-dark">
            <li class="list-group-item bg-dark text-white">Nacimiento: {{ $data['dateOfBirth'] }}
                ({{ $data['placeOfBirth']['city'] }}, {{ $data['placeOfBirth']['country'] }})</li>
            <li class="list-group-item bg-dark text-white">Edad: {{ $data['age'] }}</li>
            <li class="list-group-item bg-dark text-white">Altura: {{ $data['height'] }} cm</li>
            <li class="list-group-item bg-dark text-white">Ciudadanía: {{ implode(', ', $data['citizenship']) }}</li>
            <li class="list-group-item bg-dark text-white">Posición principal: {{ $data['position']['main'] }}</li>
            <li class="list-group-item bg-dark text-white">Otras posiciones: {{ implode(', ', $data['position']['other']) }}
            </li>
            <li class="list-group-item bg-dark text-white">Valor de mercado:
                {{ number_format($data['marketValue'] / 1_000_000, 2) }} M €</li>
        </ul>

        <a href="{{ url()->previous() }}" class="btn btn-outline-light mt-3">← Volver</a>
    </div>
@endsection