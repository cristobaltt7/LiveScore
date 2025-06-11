<!DOCTYPE html>
<html lang="es">
@include('layouts.head')

<head>
  <!-- DataTables Bootstrap 5 -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body class="d-flex flex-column min-vh-100">
  <div class="overlay" id="calendarOverlay"></div>

  {{-- Sidebar IZQUIERDO --}}
  @include('layouts.sidebar')

  {{-- Sidebar DERECHO (News) --}}
  @include('layouts.news-sidebar')

  {{-- CONTENEDOR CENTRAL (entre sidebars) --}}
  <div class="content-wrapper d-flex flex-column flex-grow-1" style="margin-left: 70px; margin-right: 30px;">
    <div class="main-content container-fluid py-3 px-4">
      @yield('content')
    </div>
  </div>

  {{-- FOOTER CENTRADO ENTRE LOS SIDE BARS (fuera del content-wrapper) --}}
  <footer class="mt-auto custom-footer" style="margin-left: 70px; margin-right: 30px;">
    @include('layouts.footer')
  </footer>

  @include('layouts.scripts')
  @yield('scripts')

  <!-- jQuery y Bootstrap -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="{{ asset('js/sidebar-search.js') }}"></script>
  <script src="{{ asset('js/daily-quote.js') }}"></script>
</body>
</html>