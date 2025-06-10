@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/styles.css') }}">

<div class="container py-5">
    <h1 class="text-white mb-4">Equipos Favoritos</h1>

    @if (!empty($favorites))
        <div class="mb-3">
            <input type="text" id="searchInput" class="form-control" placeholder="Buscar equipo por nombre...">
        </div>

        <div class="row" id="favoritesContainer">
@foreach($favorites as $id => $info)
    @php
        $transfermarktId = $info['transfermarkt_id'] ?? null;
    @endphp

    @if($transfermarktId)
    <div class="card bg-dark text-white mb-3 team-card-wrapper">
        <div class="card-body d-flex align-items-center justify-content-between">
            <div>
                <img src="{{ $info['logo'] }}" alt="{{ $info['name'] }}" style="width:40px; height:40px;">
                <strong class="ms-3 team-name">{{ $info['name'] }}</strong>
            </div>
            <a href="{{ route('club.ver', ['id' => $transfermarktId]) }}" class="btn btn-outline-light">Ver equipo</a>
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
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const input = document.getElementById('searchInput');
        const cards = document.querySelectorAll('.team-card-wrapper');

        input.addEventListener('input', function () {
            const query = this.value.toLowerCase();
            cards.forEach(card => {
                const name = card.querySelector('.team-name').textContent.toLowerCase();
                card.style.display = name.includes(query) ? 'block' : 'none';
            });
        });
    });
</script>
@endsection
