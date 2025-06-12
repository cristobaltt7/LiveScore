@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

    <div class="container py-4 text-white">
        <h1 class="mb-4">Clubes de La Liga</h1>

        {{-- Buscador de clubes --}}
        <div class="mb-4 text-center">
            <div class="search-input-wrapper position-relative mx-auto" style="max-width: 400px;">
                <i class="bi bi-search position-absolute top-50 start-0 translate-middle-y ms-2 text-white"></i>
                <input type="text" id="clubSearch" class="form-control ps-5" placeholder="Buscar equipos...">
            </div>
        </div>

        {{-- Lista de clubes --}}
        <div class="row" id="clubList">
            @foreach($clubs as $club)
                <div class="col-md-4 mb-4 club-card" data-name="{{ strtolower($club['name']) }}">
                    <div class="card bg-dark text-white shadow-sm h-100">
                        <div class="card-body d-flex flex-column align-items-center justify-content-center">
                            <img src="{{ $club['logo'] }}" alt="{{ $club['name'] }}" style="width: 60px; height: 60px;">
                            <h5 class="mt-3 text-center">{{ $club['name'] }}</h5>
                            <a href="{{ route('players.index', ['clubId' => $club['id']]) }}"
                                class="btn btn-outline-light mt-3">Ver equipo</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/clubes.js') }}"></script>

@endsection