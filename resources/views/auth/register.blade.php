<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Signup - LiveScore</title>
  <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
  />
</head>
<body>
  <div
    class="container d-flex justify-content-center align-items-center signup-container"
  >
    <div class="signup-card">
      <div class="signup-logo">
        <img
          src="/images/logo.png"
          alt="LiveScore Logo"
          style="max-width: 250px"
        />
      </div>
      <h2 class="text-center mt-1 mb-4">Signup</h2>

      @if ($errors->any())
      <div class="alert alert-danger">
        <ul class="mb-0">
          @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
      @endif

      <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="mb-3">
          <input
            type="text"
            name="name"
            class="form-control"
            placeholder="Enter Your Username"
            required
          />
        </div>

        <div class="mb-3">
          <input
            type="email"
            name="email"
            class="form-control"
            placeholder="Enter Your Email"
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

        <div class="mb-3">
          <input
            type="password"
            name="password_confirmation"
            class="form-control"
            placeholder="Confirm Your Password"
            required
          />
        </div>

        <button type="submit" class="btn btn-signup w-100 text-white">
          Signup
        </button>

        <div class="text-center mt-3">
          Already have an account?
          <a href="{{ route('login') }}" class="text-link">Login</a>
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
    font-family: "Segoe UI", sans-serif;
    background-image: url("/images/fondo_login.jpg");
  }
  .signup-container {
    min-height: 100vh;
  }
  .signup-card {
    width: 100%;
    max-width: 400px;
    background: white;
    padding: 2rem;
    border-radius: 10px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);
  }
  .signup-card h2 {
    font-weight: 700;
    margin-top: 0.25rem;
    margin-bottom: 1rem;
  }
  .signup-logo {
    margin-bottom: 0.5rem;
    text-align: center;
  }
  .logo-img {
    max-width: 150px;
    height: auto;
    display: inline-block;
  }
  .form-control:focus {
    box-shadow: none;
    border-color: #00cc33;
  }
  .btn-signup {
    background-color: #28a745;
    border: none;
  }
  .btn-signup:hover {
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
<script src="{{ asset('js/register-validation.js') }}"></script>

</html>
