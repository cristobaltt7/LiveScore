<!DOCTYPE html>
<html lang="es">
@include('layouts.head')

<head>
  <!-- DataTables Bootstrap 5 -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
  <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
  <div class="overlay" id="calendarOverlay"></div>

  @include('layouts.calendar')
  @include('layouts.sidebar')

  <div class="container-fluid">
    <div class="row">
      <!-- Contenido principal -->
      <div class="col-lg-9 main-content py-3 px-4">
        @yield('content')
      </div>

    </div>
  </div>

  @include('layouts.footer')
  @include('layouts.scripts')
  @yield('scripts')

  <!-- jQuery y DataTables -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
</body>
</html>
