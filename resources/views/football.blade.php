@extends('layouts.app')

@section('content')
  <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

  <div class="football-page bg-dark py-4">
    <div class="container">
    <div class="row">

      <!-- Cabecera con título y buscador -->
      <div class="football-header text-center mb-4">
      <h1 class="text-white"><i class="bi bi-people"></i> Equipos de Fútbol</h1>
      <div class="search-container" id="searchContainer">
        <div class="search-input-wrapper position-relative mx-auto" style="max-width: 400px;">
        <i class="bi bi-search position-absolute top-50 start-0 translate-middle-y ms-2 text-white"></i>
        <input type="text" class="form-control ps-5" id="teamSearch" placeholder="Buscar equipos...">
        <div class="search-results" id="searchResults"></div>
        </div>
      </div>
      </div>

      <!-- Equipo seleccionado -->
      <div class="selected-team-container" id="selectedTeamContainer" style="display: none;">
      <div class="card bg-secondary border-0 text-white mb-4">
        <div class="card-header bg-primary d-flex align-items-center">
        <img id="teamLogo" src="" alt="Escudo" class="me-3 team-logo" style="height: 50px;">
        <h3 id="teamName" class="mb-0"></h3>
        </div>
        <div class="card-body">
        <div class="row">
          <div class="col-md-6 mb-3">
          <h5 class="border-bottom pb-1">Información del equipo</h5>
          <ul class="list-unstyled">
            <li><strong>País:</strong> <span id="teamCountry"></span></li>
            <li><strong>Fundado:</strong> <span id="teamFounded"></span></li>
            <li><strong>Estadio:</strong> <span id="teamStadium"></span></li>
          </ul>
          </div>
        </div>
        </div>
      </div>

      <!-- Sección plantilla completa -->
      <h5 class="border-bottom pb-1 w-100 text-white">Plantilla</h5>
      <div id="fullSquadContainer" class="mb-5"></div>

      <!-- Sección de once personalizado -->
      <h5 class="border-bottom pb-1 w-100 text-white">Crea tu once</h5>
      <div id="customLineupContainer" class="mb-4"></div>
      <div id="lineupSelector" class="mb-4"></div>

      <!-- Campo de fútbol con alineación -->
      <div class="football-field-container mb-4 position-relative">
        <img src="{{ asset('images/football_field.jpg') }}" alt="Campo de fútbol"
        class="football-field w-100 rounded shadow">
        <div id="formationPlayers"></div>
      </div>

      <!-- Botón para volver a la lista de equipos -->
      <div class="text-center mb-4">
        <button class="btn btn-outline-light" onclick="volverALista()">← Volver a equipos</button>
      </div>
      </div>

      <!-- Lista de equipos populares (La Liga) -->
      <div class="popular-teams" id="popularTeams">
      <h3 class="text-white mb-3">Equipos de La Liga</h3>
      <div class="row row-cols-2 row-cols-md-4 g-3">
        @foreach($teams as $team)
        @php $isFav = in_array($team['id'], $favoritos); @endphp
        <div class="col">
        <!-- Tarjeta de equipo -->
        <div class="team-card bg-secondary text-center p-3 rounded shadow-sm h-100 position-relative"
        data-team-id="{{ $team['id'] }}" data-club-id="{{ $team['club_id'] ?? '' }}"
        data-football-id="{{ $team['id'] }}" data-transfermarkt-id="{{ $team['club_id'] ?? '' }}"
        data-team-name="{{ $team['name'] }}" data-team-logo="{{ $team['crest'] }}">

        <!-- Icono de favorito (corazón) -->
        <i class="favorite-icon position-absolute top-0 end-0 m-2 
       {{ $isFav ? 'bi-heart-fill text-danger' : 'bi-heart text-white' }}" style="cursor: pointer; font-size: 1.3rem;"
        data-favorite="{{ $isFav ? '1' : '0' }}" data-team-id="{{ $team['id'] }}"
        data-transfermarkt-id="{{ $team['club_id'] ?? '' }}" data-team-name="{{ $team['name'] }}"
        data-team-logo="{{ $team['crest'] }}">
        </i>

        <!-- Logo y nombre del equipo -->
        <img src="{{ $team['crest'] }}" alt="{{ $team['name'] }}" class="team-logo mb-2" style="height: 60px;">
        <h6 class="text-white mb-0">{{ $team['name'] }}</h6>
        </div>
        </div>
      @endforeach
      </div>
      </div>
    </div>
    </div>

  @endsection

  @section('scripts')
  
    <!-- Script para mantener el scroll en el equipo seleccionado -->
    @if (session('scrollToTeamId'))
    <script>
    localStorage.setItem('scrollToTeamId', '{{ session('scrollToTeamId') }}');
    </script>
    @endif

    <script src="{{ asset('js/football.js') }}"></script>
    <script src="{{ asset('js/teamSquad.js') }}"></script>
    <script src="{{ asset('js/volverALista.js') }}"></script>
    <script src="{{ asset('js/teamSearch.js') }}"></script>
  @endsection