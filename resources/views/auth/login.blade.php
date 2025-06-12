<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Login - LiveScore</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" />
  <link rel="stylesheet" href="{{ asset('css/login.css') }}">

</head>

<body>

  <!-- Mensaje si el usuario ha eliminado su cuenta -->
  @if(session('status') === 'account-deleted')
    <div class="alert alert-info">
    Tu cuenta ha sido eliminada exitosamente.
    </div>
  @endif

  <!-- Error backend si login falla -->
  @if (session('error'))
    <div id="backend-error" data-login-error="{{ session('error') }}"></div>
  @endif

  <!-- Contenedor principal -->
  <div class="container d-flex justify-content-center align-items-center login-container">
    <div class="login-card">
      <div class="login-logo">
        <img src="/images/logo.png" alt="LiveScore Logo" style="max-width: 250px" />
      </div>

      <h2 class="text-center mt-1 mb-4">Login</h2>

      
      <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="mb-3 position-relative">
          <input type="text" name="email" class="form-control" placeholder="Introduce tu correo" required />
          <span class="form-icon" onclick="togglePassword()">
            <i class="fa fa-eye" id="toggleIcon"></i>
          </span>
        </div>

        <div class="mb-3 position-relative">
          <input type="password" name="password" class="form-control" placeholder="Introduce tu contraseña" required />
          <span class="form-icon"><i class="fa fa-eye-slash"></i></span>
        </div>

        <div class="mb-3 text-end">
          <a href="{{ route('password.forgot') }}" class="text-link">¿Olvidaste tu contraseña?</a>
        </div>

        <button type="submit" class="btn btn-login w-100 text-white">Login</button>

        <div class="text-center mt-3">
          No tienes una cuenta?
          <a href="{{ route('register') }}" class="text-link">Registro</a>
        </div>
      </form>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</body>


<script src="{{ asset('js/login-validation.js') }}"></script>

</html>