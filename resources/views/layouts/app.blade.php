<!DOCTYPE html>
<html lang="es">
@include('layouts.head')

<head>
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="football-token" content="{{ env('FOOTBALL_DATA_API_TOKEN') }}">

</head>

<body class="d-flex flex-column min-vh-100">
  <div class="overlay" id="calendarOverlay"></div>

  {{-- Sidebar IZQUIERDO --}}
  @include('layouts.sidebar')

  {{-- Sidebar DERECHO (News) --}}
  @if (!Request::is('noticias'))
    <div class="col-lg-3">
    <div class="news-sidebar sticky-top" style="top: -10px;">
      <h5 class="mb-4">
      <a href="/noticias" class="text-decoration-none text-white d-flex align-items-center">
        <i class="bi bi-fire"></i> Noticias <i class="bi bi-arrow-right ms-auto"></i>
      </a>
      </h5>
      @include('layouts.news-sidebar')
    </div>
    </div>
  @endif


  {{-- CONTENEDOR CENTRAL (entre sidebars) --}}
  <div class="content-wrapper d-flex flex-column flex-grow-1" style="margin-left: 70px; margin-right: 30px;">
    <div class="main-content container-fluid py-3 px-4">
      @yield('content')
    </div>
  </div>

  {{-- FOOTER --}}
  <footer class="mt-auto custom-footer" style="margin-left: 70px; margin-right: 30px;">
    @include('layouts.footer')
  </footer>

  @include('layouts.scripts')
  @yield('scripts')

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="{{ asset('js/sidebar-search.js') }}"></script>
  <script src="{{ asset('js/daily-quote.js') }}"></script>
  <script src="{{ asset('js/sidebar-news.js') }}"></script>

</body>
</html>