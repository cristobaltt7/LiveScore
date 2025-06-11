@extends('layouts.app')

@section('content')

<link rel="stylesheet" href="{{ asset('css/styles.css') }}">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

{{-- Banner --}}
<div id="bannerCarousel" class="carousel slide banner-carousel shadow mb-4" data-bs-ride="carousel">
  <div class="carousel-inner rounded">
    <div class="carousel-item active">
      <img src="https://via.placeholder.com/800x200/333/00cc33?text=Champions+League" class="d-block w-100" alt="Champions League">
    </div>
    <div class="carousel-item">
      <img src="https://via.placeholder.com/800x200/333/0066cc?text=Premier+League" class="d-block w-100" alt="Premier League">
    </div>
    <div class="carousel-item">
      <img src="https://via.placeholder.com/800x200/333/cc0000?text=NBA+Playoffs" class="d-block w-100" alt="NBA Playoffs">
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#bannerCarousel" data-bs-slide="prev">
    <span class="carousel-control-prev-icon"></span>
    <span class="visually-hidden">Anterior</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#bannerCarousel" data-bs-slide="next">
    <span class="carousel-control-next-icon"></span>
    <span class="visually-hidden">Siguiente</span>
  </button>
</div>

{{-- CONTENEDOR CENTRAL ENTRE SIDEBARS --}}
<div class="content-wrapper d-flex flex-column flex-grow-1" style="margin-left: 70px; margin-right: 30px;">
  <div class="main-content container-fluid py-3 px-4">

    {{-- Accesos rápidos --}}
    <section class="container mt-3 mb-5">
      <div class="row text-center g-4">
        <div class="col-md-3">
          <a href="/football" class="text-decoration-none text-white">
            <div class="p-4 bg-gradient rounded shadow hover-glow">
              <i class="bi bi-trophy-fill fs-2 d-block mb-2 text-success"></i>
              <strong>Partidos en directo</strong>
            </div>
          </a>
        </div>
        <div class="col-md-3">
          <a href="/liga/resultados" class="text-decoration-none text-white">
            <div class="p-4 bg-gradient rounded shadow hover-glow">
              <i class="bi bi-bar-chart-fill fs-2 d-block mb-2 text-warning"></i>
              <strong>Clasificaciones</strong>
            </div>
          </a>
        </div>
        <div class="col-md-3">
          <a href="/noticias" class="text-decoration-none text-white">
            <div class="p-4 bg-gradient rounded shadow hover-glow">
              <i class="bi bi-newspaper fs-2 d-block mb-2 text-info"></i>
              <strong>Últimas noticias</strong>
            </div>
          </a>
        </div>
        <div class="col-md-3">
          <a href="/player-statistics" class="text-decoration-none text-white">
            <div class="p-4 bg-gradient rounded shadow hover-glow">
              <i class="bi bi-person-lines-fill fs-2 d-block mb-2 text-danger"></i>
              <strong>Estadísticas de jugadores</strong>
            </div>
          </a>
        </div>
      </div>
    </section>

  </div>
</div>

{{-- Sidebar derecho (noticias) --}}
<div class="news-sidebar">
  <h5 class="mb-4">
    <a href="/noticias" class="text-decoration-none text-white d-flex align-items-center">
      <i class="bi bi-fire"></i> Trending News <i class="bi bi-arrow-right ms-auto"></i>
    </a>
  </h5>
  @include('layouts.news-sidebar')
</div>

@endsection
