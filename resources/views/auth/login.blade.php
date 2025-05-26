<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Login - LiveScore</title>
  <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
  />
</head>
<body>
  <div
    class="container d-flex justify-content-center align-items-center login-container"
  >
    <div class="login-card">
      <div class="login-logo">
        <img
          src="/images/logo.png"
          alt="LiveScore Logo"
          style="max-width: 250px"
        />
      </div>

      <h2 class="text-center mt-1 mb-4">Login</h2>

      <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="mb-3 position-relative">
          <input
            type="text"
            name="email"
            class="form-control"
            placeholder="Enter Your Username / Email"
            required
          />
        </div>

        <div class="mb-3 position-relative">
          <input
            type="password"
            name="password"
            class="form-control"
            placeholder="Enter Your Password"
            required
          />
          <span class="form-icon"><i class="fa fa-eye-slash"></i></span>
        </div>

        <div class="mb-3 text-end">
          <a href="#" class="text-link">Forgot Password?</a>
        </div>

        <button type="submit" class="btn btn-login w-100 text-white">Login</button>

        <div class="text-center mt-3">
          Don’t have an account?
          <a href="{{ route('register') }}" class="text-link">Signup</a>
        </div>
      </form>
    </div>
  </div>

  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
  ></script>
  <script
    src="https://kit.fontawesome.com/a076d05399.js"
    crossorigin="anonymous"
  ></script>
</body>
<style>
  body {
    background-color: #2e2e2e;
    background-image: url("/images/fondo_login.jpg");
    font-family: "Segoe UI", sans-serif;
  }
  .login-container {
    min-height: 100vh;
  }
  .login-card {
    width: 100%;
    max-width: 400px;
    background: white;
    padding: 2rem;
    border-radius: 10px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);
  }
  .login-card h2 {
    font-weight: 700;
    /* Reduce margin-top para subir el título */
    margin-top: 0.25rem; /* antes podía ser 1rem o más */
    margin-bottom: 1rem;
  }
  .login-logo {
    color: #00cc33;
    font-size: 1.8rem;
    font-weight: bold;
    margin-bottom: 0.5rem; /* menos espacio debajo del logo */
    text-align: center;
  }
  .form-control:focus {
    box-shadow: none;
    border-color: #00cc33;
  }
  .btn-login {
    background-color: #28a745;
    border: none;
  }
  .btn-login:hover {
    background-color: #218838;
  }
  .text-link {
    color: #007bff;
    text-decoration: none;
  }
  .text-link:hover {
    text-decoration: underline;
  }
  .form-icon {
    position: absolute;
    right: 15px;
    top: 50%;
    transform: translateY(-50%);
    color: #ccc;
  }
  .error-message {
  color: red;
  font-size: 0.9em;
  margin-top: 2px;
  margin-bottom: 8px;
}
</style>
<script src="{{ asset('js/login-validation.js') }}"></script>

</html>
