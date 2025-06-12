<link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">


<div class="sidebar">
    <div class="sidebar-content">
        <div class="logo text-center mb-2">
            <img src="/images/logo.png" alt="LiveScore Logo">
        </div>

        {{-- Buscador --}}
        <input type="text" class="form-control form-control-sm" placeholder="🔍 Buscar..." id="sidebarSearchInput">

        {{-- Home --}}
        <a href="/" class="{{ request()->is('/') ? 'active' : '' }}">
            <i class="bi bi-house-door"></i> <span>Home</span>
        </a>

        {{-- Fútbol --}}
        <a href="/football" class="{{ request()->is('football') ? 'active' : '' }}">
            <i class="bi bi-people"></i> <span>Fútbol</span>
        </a>

        {{-- Resultados --}}
        <a href="/liga/resultados" class="{{ request()->is('liga/resultados') ? 'active' : '' }}">
            <i class="bi bi-trophy"></i> <span>Resultados</span>
        </a>

        {{-- Noticias --}}
        <a href="/noticias" class="{{ request()->is('noticias') ? 'active' : '' }}">
            <i class="bi bi-newspaper"></i> <span>Noticias</span>
        </a>

        <hr class="border-secondary">

        {{-- Equipos favoritos --}}
        @auth
            <a href="/followed-team" class="{{ request()->is('followed-team') ? 'active' : '' }}">
                <i class="bi bi-heart"></i> <span>Equipos favoritos</span>
            </a>
        @endauth

        {{-- Estadísticas jugadores --}}
        <a href="{{ route('player-statistics.index') }}"
            class="{{ request()->is('player-statistics*') ? 'active' : '' }}">
            <i class="bi bi-person"></i> <span>Estadísticas jugadores</span>
        </a>


        {{-- Tema --}}
        <div class="theme-settings mt-3">
            <h6><i class="bi bi-palette"></i> <span>Tema</span></h6>
            <div class="theme-buttons d-flex flex-column gap-1">
                <button class="theme-btn btn btn-sm" id="lightModeBtn">
                    <i class="bi bi-sun"></i> Claro
                </button>
                <button class="theme-btn btn btn-sm" id="darkModeBtn">
                    <i class="bi bi-moon"></i> Oscuro
                </button>
            </div>
        </div>

        {{-- Frase del día --}}
        <div class="setting-item mt-4 frase-del-dia">
            <h6 class="d-flex align-items-center">
                <i class="bi bi-chat-quote me-2 text-secondary"></i> Frase del día
            </h6>
            <p id="dailyQuote" class="fst-italic text-white mb-0"></p>
        </div>

    </div>

    {{-- Perfil --}}
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
            <a href="{{ route('login') }}" class="btn btn-outline-light btn-sm w-100 mb-2">
                <i class="bi bi-box-arrow-in-right"></i> Login
            </a>
            <a href="{{ route('register') }}" class="btn btn-outline-light btn-sm w-100">
                <i class="bi bi-person-plus"></i> Registro
            </a>
        </div>
    @endauth
</div>

<script src="{{ asset('js/sidebar.js') }}"></script>