<div class="sidebar">
    <div class="sidebar-content">
        <div class="logo">
            <img src="/images/logo.png" alt="LiveScore Logo">
        </div>

        <input type="text" class="form-control form-control-sm" placeholder="🔍 Search..." id="sidebarSearchInput">

        <a href="/" class="active"><i class="bi bi-house-door"></i> <span>Home</span></a>
        <a href="/football"><i class="bi bi-people"></i> <span>Football</span></a>
        <a href="/liga/resultados"><i class="bi bi-trophy"></i> <span>Results</span></a>
        <a href="/noticias"><i class="bi bi-newspaper"></i> <span>Noticias</span></a>

        <hr class="border-secondary">

@auth
  <a href="/followed-team"><i class="bi bi-heart"></i> <span>Followed Team</span></a>
@endauth

<a href="{{ route('player-statistics.index') }}">
  <i class="bi bi-person"></i> <span>Players statistics</span>
</a>


        <div class="theme-settings">
            <h6><i class="bi bi-palette"></i> <span>Theme Settings</span></h6>
            <div class="theme-buttons">
                <button class="theme-btn" id="lightModeBtn"><i class="bi bi-sun"></i> <span>Light</span></button>
                <button class="theme-btn" id="darkModeBtn"><i class="bi bi-moon"></i> <span>Dark</span></button>
            </div>
        </div>

        <div class="setting-item mt-3 text-white small">
            <h6><i class="bi bi-chat-quote"></i> Frase del día</h6>
            <blockquote id="dailyQuote" class="fst-italic mt-2"></blockquote>
        </div>
    </div>

    <!-- BLOQUE DE PERFIL -->
    @auth
        <div class="profile" id="profileButton">
            <div>
                <div class="name">{{ auth()->user()->name }}</div>
                <small class="text-muted">{{ auth()->user()->email }}</small>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="btn btn-sm btn-outline-success" title="Logout">
                    <i class="bi bi-box-arrow-right"></i>
                </button>
            </form>
        </div>
    @else
        <div class="profile d-flex flex-column align-items-start p-3">
            <a href="{{ route('login') }}" class="btn btn-outline-light btn-sm w-100 mb-2"><i class="bi bi-box-arrow-in-right"></i> Login</a>
            <a href="{{ route('register') }}" class="btn btn-outline-light btn-sm w-100"><i class="bi bi-person-plus"></i> Sign Up</a>
        </div>
    @endauth
</div>
<script>
document.addEventListener('DOMContentLoaded', function () {
  const frases = [
    "La disciplina tarde o temprano vencerá al talento.",
    "No cuentes los días, haz que los días cuenten. – Muhammad Ali",
    "El fútbol es simple, pero es difícil jugar simple. – Cruyff",
    "Si no crees que eres el mejor, nunca lo lograrás. – Cristiano Ronaldo",
    "Prefiero perder un partido por nueve goles que nueve partidos por un gol. – Vujadin Boskov"
  ];
  const aleatoria = frases[Math.floor(Math.random() * frases.length)];
  document.getElementById('dailyQuote').innerText = aleatoria;
});
</script>
  
  <script>

document.addEventListener('DOMContentLoaded', function () {
    const input = document.getElementById('sidebarSearchInput');

    input.addEventListener('keypress', function (e) {
        if (e.key === 'Enter') {
            e.preventDefault();

            const value = input.value.trim().toLowerCase();

            if (value.includes('football')) {
                window.location.href = '/football';
            } else if (value.includes('result') || value.includes('liga')) {
                window.location.href = '/liga/resultados';
            } else if (value.includes('noticia') || value.includes('news')) {
                window.location.href = '/noticias';
            } else if (value.includes('followed')) {
                window.location.href = '/followed-team';
            } else if (value.includes('player') || value.includes('statistic')) {
                window.location.href = '{{ route('player-statistics.index') }}';
            } else if (value === 'home') {
                window.location.href = '/';
            } else {
                alert('No se encontró ninguna sección con ese nombre.');
            }
        }
    });
});
</script>
