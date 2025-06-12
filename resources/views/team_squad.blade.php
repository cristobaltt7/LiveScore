<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Plantilla Equipo</title>
  <link rel="stylesheet" href="{{ asset('css/field.css') }}">

</head>

<body>
  <h1>Plantilla del Equipo (4-3-3)</h1>

  <!-- Contenedor del campo con divisiones para cada línea -->
  <div class="field" id="field">
    <div class="goalkeepers"></div>
    <div class="defenders"></div>
    <div class="midfielders"></div>
    <div class="forwards"></div>
  </div>

  <!-- Inyección del ID del equipo desde Blade a JavaScript -->
  <script>
    const teamId = "{{ $teamId }}";
  </script>
  <script src="{{ asset('js/field.js') }}"></script>
</body>

</html>