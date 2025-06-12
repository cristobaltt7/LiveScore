<footer class="footer bg-dark text-white mt-auto py-3 w-100">
  <div class="container px-4" style="max-width: 1200px; margin: 0 auto;">
    <div class="row justify-content-between align-items-center">

      {{-- Logo y descripción --}}
      <div class="col-md-4 mb-3 text-center text-md-start">
        <div class="d-flex align-items-center justify-content-center justify-content-md-start mb-2">
          <img src="/images/logo.png" alt="LiveScore Logo" width="200" class="me-2">
        </div>
        <p class="text-white small mb-1">La mejor fuente de resultados deportivos en tiempo real.</p>
        <div class="social-icons d-flex justify-content-center justify-content-md-start mt-2">
          <a href="https://www.facebook.com" target="_blank" class="text-white me-3" aria-label="Facebook">
            <i class="bi bi-facebook fs-5"></i>
          </a>
          <a href="https://twitter.com" target="_blank" class="text-white me-3" aria-label="Twitter/X">
            <i class="bi bi-twitter-x fs-5"></i>
          </a>
          <a href="https://www.instagram.com" target="_blank" class="text-white me-3" aria-label="Instagram">
            <i class="bi bi-instagram fs-5"></i>
          </a>
          <a href="https://www.youtube.com" target="_blank" class="text-white" aria-label="YouTube">
            <i class="bi bi-youtube fs-5"></i>
          </a>
        </div>

      </div>

      {{-- Enlaces horizontales --}}
      <div class="col-md-6 mb-3 text-center text-md-end">
        <h6 class="text-success mb-3">Enlaces rápidos</h6>
        <div class="d-flex justify-content-center justify-content-md-end flex-wrap gap-3">
          <a href="/" class="text-white text-decoration-none">Home</a>
          <a href="/football" class="text-white text-decoration-none">Football</a>
          <a href="/liga/resultados" class="text-white text-decoration-none">Resultados</a>
          <a href="/noticias" class="text-white text-decoration-none">Noticias</a>
        </div>
      </div>

    </div>

    {{-- Footer --}}
    <div class="row mt-4 pt-3 border-top border-secondary text-center text-md-start">
      <div class="col-md-6">
        <p class="small text-white mb-0">© 2025 LiveScore. Todos los derechos reservados.</p>
      </div>
      <div class="col-md-6 text-md-end mt-2 mt-md-0">
        <a href="{{ route('terminos') }}" class="text-white small text-decoration-none me-3">Términos</a>
        <a href="{{ route('privacidad') }}" class="text-white small text-decoration-none">Privacidad</a>
      </div>
    </div>
  </div>
</footer>