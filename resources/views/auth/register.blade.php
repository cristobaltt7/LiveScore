<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Registro - LiveScore</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" />
  <link rel="stylesheet" href="{{ asset('css/signup.css') }}">

</head>

<body>

  <!-- Contenedor centrado con tarjeta de registro -->
  <div class="container d-flex justify-content-center align-items-center signup-container">
    <div class="signup-card">
      <div class="signup-logo">
        <img src="/images/logo.png" alt="LiveScore Logo" style="max-width: 250px" />
      </div>

      <h2 class="text-center mt-1 mb-4">Registro</h2>

      @if ($errors->any())
      <div class="alert alert-danger">
      <ul class="mb-0">
        @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
      @endforeach
      </ul>
      </div>
    @endif

      <!-- Formulario de registro -->
      <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="mb-3">
          <input type="text" name="name" class="form-control" placeholder="Introduce un nombre de usuario" required />
        </div>

        <div class="mb-3">
          <input type="email" name="email" class="form-control" placeholder="Introduce un correo" required />
        </div>

        <div class="mb-3 position-relative">
          <input type="password" name="password" class="form-control" placeholder="Introduce un contraseña" required />
          <span class="form-icon"><i class="fa fa-eye-slash"></i></span>
        </div>

        <div class="mb-3">
          <input type="password" name="password_confirmation" class="form-control" placeholder="Confirma tu contraseña"
            required />
        </div>

        <!-- Pregunta secreta -->
        <div class="mb-3">
          <select name="secret_question" class="form-control" required>
            <option value="">Selecciona una pregunta secreta</option>
            <option value="mascota">¿Cómo se llama tu primera mascota?</option>
            <option value="comida">¿Cuál es tu comida favorita?</option>
            <option value="ciudad">¿En qué ciudad naciste?</option>
          </select>
        </div>

        <div class="mb-3">
          <input type="text" name="secret_answer" class="form-control" placeholder="Tu respuesta secreta" required />
        </div>

        <button type="submit" class="btn btn-signup w-100 text-white">
          Registro
        </button>

        <div class="text-center mt-3">
          Ya tienes una cuenta?
          <a href="{{ route('login') }}" class="text-link">Login</a>
        </div>
      </form>

    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</body>

<script src="{{ asset('js/register-validation.js') }}"></script>

</html>