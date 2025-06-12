@extends('layouts.app')

@section('content')

  <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

  {{-- Banner --}}
  <div id="bannerCarousel" class="carousel slide banner-carousel shadow mb-4" data-bs-ride="carousel">
    <div class="carousel-inner rounded">

    {{-- Imagen activa --}}
    <div class="carousel-item active">
      <img src="{{ asset('images/banner6.webp') }}" class="d-block w-100" style="height: 220px; object-fit: cover;"
      alt="Banner 1">
    </div>

    {{-- Resto de imágenes --}}
    <div class="carousel-item">
      <img src="{{ asset('images/banner8.jpeg') }}" class="d-block w-100" style="height: 220px; object-fit: cover;"
      alt="Banner 2">
    </div>
    <div class="carousel-item">
      <img src="{{ asset('images/banner3.webp') }}" class="d-block w-100" style="height: 220px; object-fit: cover;"
      alt="Banner 3">
    </div>
    <div class="carousel-item">
      <img src="{{ asset('images/banner7.png') }}" class="d-block w-100" style="height: 220px; object-fit: cover;"
      alt="Banner 4">
    </div>
    <div class="carousel-item">
      <img src="{{ asset('images/banner9.jpg') }}" class="d-block w-100" style="height: 220px; object-fit: cover;"
      alt="Banner 5">
    </div>
    <div class="carousel-item">
      <img src="{{ asset('images/banner10.jpg') }}" class="d-block w-100" style="height: 220px; object-fit: cover;"
      alt="Banner 6">
    </div>
    <div class="carousel-item">
      <img src="{{ asset('images/banner2.jpg') }}" class="d-block w-100" style="height: 220px; object-fit: cover;"
      alt="Banner 7">
    </div>
    <div class="carousel-item">
      <img src="{{ asset('images/banner1.jpg') }}" class="d-block w-100" style="height: 220px; object-fit: cover;"
      alt="Banner 8">
    </div>
    <div class="carousel-item">
      <img src="{{ asset('images/banner4.png') }}" class="d-block w-100" style="height: 220px; object-fit: cover;"
      alt="Banner 9">
    </div>
    <div class="carousel-item">
      <img src="{{ asset('images/banner5.jpg') }}" class="d-block w-100" style="height: 220px; object-fit: cover;"
      alt="Banner 10">
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


  {{-- CONTENEDOR CENTRAL --}}
  <div class="content-wrapper d-flex flex-column flex-grow-1 align-items-center" style="margin: 0 auto;">
    <div class="main-content container-fluid py-4">

    <section class="w-100 text-white">

      {{-- BLOQUE 1 --}}
      <div class="mb-5 p-5 bg-dark border-start border-success border-4 rounded shadow w-100"
      style="max-width: 100%; margin-left: 1.5rem;">
      <h3 class="text-success"><i class="bi bi-trophy-fill"></i> Football</h3>
      <p class="text-white">Explora todos los equipos de la liga española, accede a su información completa y crea tu
        propio once ideal en una vista de campo profesional.</p>
      <div class="text-end">
        <a href="/football" class="btn btn-home mt-2">Ir a Partidos en directo</a>
      </div>
      </div>


      {{-- BLOQUE 2 --}}
      <div class="mb-5 p-5 bg-dark border-start border-warning border-4 rounded shadow w-100"
      style="max-width: 100%; margin-left: 1.5rem;">
      <h3 class="text-warning"><i class="bi bi-bar-chart-fill"></i> Clasificaciones</h3>
      <p class="text-white">Consulta la tabla de posiciones de cada jornada, analiza el rendimiento local y visitante
        y sigue la evolución de tus equipos favoritos.</p>
      <div class="text-end">
        <a href="/liga/resultados" class="btn btn-home mt-2">Ver Clasificaciones</a>
      </div>
      </div>

      {{-- BLOQUE 3 --}}
      <div class="mb-5 p-5 bg-dark border-start border-info border-4 rounded shadow w-100"
      style="max-width: 100%; margin-left: 1.5rem;">
      <h3 class="text-info"><i class="bi bi-newspaper"></i> Noticias</h3>
      <p class="text-white">Mantente informado con las noticias más destacadas del fútbol. Rumores, fichajes,
        declaraciones y todo lo que necesitas saber.</p>
      <div class="text-end">
        <a href="/noticias" class="btn btn-home mt-2">Ver Noticias</a>
      </div>
      </div>

      {{-- BLOQUE 4 --}}
      <div class="mb-5 p-5 bg-dark border-start border-danger border-4 rounded shadow w-100"
      style="max-width: 100%; margin-left: 1.5rem;">
      <h3 class="text-danger"><i class="bi bi-person-lines-fill"></i> Estadísticas</h3>
      <p class="text-white">Accede a las estadísticas más completas de los jugadores: goles, asistencias, edad,
        logros, lesiones y mucho más directamente desde Transfermarkt.</p>
      <div class="text-end">
        <a href="/player-statistics" class="btn btn-home mt-2">Ver Estadísticas</a>
      </div>
      </div>

    </section>

    </div>
  </div>

@endsection