<!DOCTYPE html>
<html lang="es">
@include('layouts.head')

<body>
<div class="overlay" id="calendarOverlay"></div>

@include('layouts.calendar')

@include('layouts.sidebar')

<div class="main-content">
  @yield('content')
</div>

@include('layouts.news-sidebar')

@include('layouts.footer')

@include('layouts.scripts')
</body>
</html>