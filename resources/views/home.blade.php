<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>LiveScore - Inicio</title>
  
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>

  <div class="overlay" id="calendarOverlay"></div>
  <div class="calendar-container" id="calendarContainer">
    <div class="calendar-header">
      <button class="btn btn-sm btn-outline-secondary" id="prevMonth"><i class="bi bi-chevron-left"></i></button>
      <h5 id="calendarMonthYear">Mayo 2025</h5>
      <button class="btn btn-sm btn-outline-secondary" id="nextMonth"><i class="bi bi-chevron-right"></i></button>
    </div>
    <div class="calendar-grid" id="calendarDaysHeader">
      <div class="calendar-day-header">L</div>
      <div class="calendar-day-header">M</div>
      <div class="calendar-day-header">X</div>
      <div class="calendar-day-header">J</div>
      <div class="calendar-day-header">V</div>
      <div class="calendar-day-header">S</div>
      <div class="calendar-day-header">D</div>
    </div>
    <div class="calendar-grid" id="calendarDays"></div>
    <div class="text-center mt-3">
      <button class="btn btn-sm btn-success me-2" id="selectDate"><i class="bi bi-check-circle"></i> Seleccionar</button>
      <button class="btn btn-sm btn-outline-secondary" id="cancelCalendar"><i class="bi bi-x-circle"></i> Cancelar</button>
    </div>
  </div>

  <div class="sidebar">
    <div class="sidebar-content">
      <div class="logo">
        <img src="/images/logo.png" alt="LiveScore Logo">
      </div>
      <input type="text" class="form-control form-control-sm" placeholder="🔍 Search...">
      
      <a href="#" class="active"><i class="bi bi-house-door"></i> <span>Home</span></a>
      <a href="/football"><i class="bi bi-people"></i> <span>Football</span></a>
      <a href="/sports"><i class="bi bi-trophy"></i> <span>Sports</span></a>
      <a href="/news"><i class="bi bi-newspaper"></i> <span>News</span></a>
      
      <hr class="border-secondary">
      
      <a href="#"><i class="bi bi-heart"></i> <span>Followed Team</span></a>
      <a href="#"><i class="bi bi-person"></i> <span>Followed Players</span></a>
          
      <div class="theme-settings">
        <h6><i class="bi bi-palette"></i> <span>Theme Settings</span></h6>
        <div class="theme-buttons">
          <button class="theme-btn" id="lightModeBtn"><i class="bi bi-sun"></i> <span>Light</span></button>
          <button class="theme-btn" id="darkModeBtn"><i class="bi bi-moon"></i> <span>Dark</span></button>
        </div>
      </div>
      
      <div class="setting-item">
        <label><i class="bi bi-translate"></i> Language</label>
        <select class="form-select form-select-sm" style="width: 100px;">
          <option>English</option>
          <option>Español</option>
          <option>Français</option>
        </select>
      </div>
    </div>
    
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
  </div>

  <div class="main-content">
    <div id="bannerCarousel" class="carousel slide banner-carousel" data-bs-ride="carousel">
      <div class="carousel-indicators">
        <button type="button" data-bs-target="#bannerCarousel" data-bs-slide-to="0" class="active"></button>
        <button type="button" data-bs-target="#bannerCarousel" data-bs-slide-to="1"></button>
        <button type="button" data-bs-target="#bannerCarousel" data-bs-slide-to="2"></button>
      </div>
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="https://via.placeholder.com/800x200/333/00cc33?text=Champions+League" class="d-block w-100" alt="Banner 1">
        </div>
        <div class="carousel-item">
          <img src="https://via.placeholder.com/800x200/333/0066cc?text=Premier+League" class="d-block w-100" alt="Banner 2">
        </div>
        <div class="carousel-item">
          <img src="https://via.placeholder.com/800x200/333/cc0000?text=NBA+Playoffs" class="d-block w-100" alt="Banner 3">
        </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#bannerCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#bannerCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>

<div class="topbar-container">
  <div class="topbar">
    <div class="live-status">
      <span class="badge bg-success pulse">
        <span class="status-indicator"></span>
        <span class="translation" data-key="live">Live</span>
      </span>
    </div>
    
    <div class="search-container">
      <div class="search-input-group">
        <input type="text" 
               class="form-control search-input" 
               placeholder="🔍 Search..." 
               aria-label="Search matches"
               id="matchSearch">
        <button class="search-clear" type="button" aria-label="Clear search">
          <i class="bi bi-x"></i>
        </button>
      </div>
      <div class="search-results dropdown-menu" aria-labelledby="matchSearch"></div>
    </div>
    
    <div class="filter-container">
      <div class="dropdown">
        <button class="btn btn-filter dropdown-toggle" type="button" id="matchFilter" data-bs-toggle="dropdown" aria-expanded="false">
          <i class="bi bi-funnel"></i>
          <span class="translation" data-key="allMatches">All Matches</span>
        </button>
        <ul class="dropdown-menu" aria-labelledby="matchFilter">
          <li>
            <a class="dropdown-item filter-option active" href="#" data-filter="all">
              <i class="bi bi-grid"></i>
              <span class="translation" data-key="allMatches">All Matches</span>
            </a>
          </li>
          <li>
            <a class="dropdown-item filter-option" href="#" data-filter="football">
              <i class="bi bi-people"></i>
              <span class="translation" data-key="football">Football</span>
            </a>
          </li>
        </ul>
      </div>
    </div>
    
    <div class="quick-actions">
      <button class="btn btn-action" title="Refresh" id="refreshMatches">
        <i class="bi bi-arrow-clockwise"></i>
      </button>
      <button class="btn btn-action" title="Notifications" id="notificationsBtn">
        <i class="bi bi-bell"></i>
      </button>
    </div>
  </div>
  

</div>

    <div class="dates-container">
 
      <button class="calendar-button" id="viewCalendarBtn"><i class="bi bi-calendar3"></i> View Calendar</button>
    </div>

<h4 class="mb-3">⚽ Resultados recientes - La Liga</h4>
<div class="match-card">
  @forelse ($fixtures as $match)
    <div class="match-item">
      <span class="team-name">{{ $match['homeTeam']['name'] }}</span>
      <span class="score">{{ $match['scores']['home_score'] }} - {{ $match['scores']['away_score'] }}</span>
      <span class="team-name">{{ $match['awayTeam']['name'] }}</span>
    </div>
  @empty
    <div class="alert alert-warning">
      @if($apiError ?? false)
        No se pudieron cargar los resultados (Error de API)
      @else
        No hay resultados disponibles
      @endif
    </div>
  @endforelse
</div>

    <h4 class="mt-5 mb-3">📊 Clasificación - La Liga</h4>
    <div class="table-responsive">
      <table class="table table-dark table-bordered table-striped">
        <thead>
          <tr>
            <th>#</th>
            <th>Equipo</th>
            <th>PJ</th>
            <th>PG</th>
            <th>PE</th>
            <th>PP</th>
            <th>GF</th>
            <th>GC</th>
            <th>PTS</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($standings as $team)
            <tr>
              <td>{{ $team['position'] }}</td>
              <td>
                @if(!empty($team['team']['image']))
                  <img src="{{ $team['team']['image'] }}" alt="{{ $team['team']['name'] }}" width="20" class="me-2">
                @endif
                {{ $team['team']['name'] }}
              </td>
              <td>{{ $team['overall']['games_played'] }}</td>
              <td>{{ $team['overall']['won'] }}</td>
              <td>{{ $team['overall']['draw'] }}</td>
              <td>{{ $team['overall']['lost'] }}</td>
              <td>{{ $team['overall']['goals_scored'] }}</td>
              <td>{{ $team['overall']['goals_against'] }}</td>
              <td>{{ $team['points'] }}</td>
            </tr>
          @empty
            <tr><td colspan="9">Clasificación no disponible.</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

  <div class="news-sidebar">
    <h5 class="mb-4">
      <a href="/news" class="text-decoration-none text-white d-flex align-items-center">
        <i class="bi bi-fire"></i> Trending News <i class="bi bi-arrow-right ms-auto"></i>
      </a>
    </h5>
    
    <div class="news-item">
      <img src="https://via.placeholder.com/80x80/333/fff?text=PL" alt="News 1">
      <div class="news-item-content">
        <h6><i class="bi bi-trophy"></i> Premier League Results</h6>
        <p>Manchester City defeats Arsenal 3-1 in crucial title clash</p>
        <small><i class="bi bi-clock"></i> 2 hours ago • <i class="bi bi-eye"></i> 1,245 views</small>
      </div>
    </div>
    
    <div class="news-item">
      <img src="https://via.placeholder.com/80x80/333/fff?text=UCL" alt="News 2">
      <div class="news-item-content">
        <h6><i class="bi bi-stars"></i> Champions League</h6>
        <p>Real Madrid advances to semifinals after dramatic comeback</p>
        <small><i class="bi bi-clock"></i> 5 hours ago • <i class="bi bi-eye"></i> 1,245 views</small>
      </div>
    </div>
    

    <div class="news-item">
      <img src="https://via.placeholder.com/80x80/333/fff?text=NBA" alt="News 3">
      <div class="news-item-content">
        <h6><i class="bi bi-basket"></i> NBA Playoffs</h6>
        <p>Lakers take 2-0 lead in series against Warriors</p>
        <small><i class="bi bi-clock"></i> 8 hours ago • <i class="bi bi-eye"></i> 1,245 views</small>
      </div>
    </div>
    
    <div class="news-item">
      <img src="https://via.placeholder.com/80x80/333/fff?text=TR" alt="News 4">
      <div class="news-item-content">
        <h6><i class="bi bi-arrow-left-right"></i> Transfer News</h6>
        <p>Mbappé reportedly agrees terms with Real Madrid</p>
        <small><i class="bi bi-clock"></i> 12 hours ago • <i class="bi bi-eye"></i> 1,245 views</small>
      </div>
    </div>
    
    <div class="news-item">
      <img src="https://via.placeholder.com/80x80/333/fff?text=INJ" alt="News 5">
      <div class="news-item-content">
        <h6><i class="bi bi-heart-pulse"></i> Injury Update</h6>
        <p>Neymar out for season with ankle injury</p>
        <small><i class="bi bi-clock"></i> 1 day ago • <i class="bi bi-eye"></i> 1,245 views</small>
      </div>
    </div>
    
    <div class="news-item">
      <img src="https://via.placeholder.com/80x80/333/fff?text=WC" alt="News 6">
      <div class="news-item-content">
        <h6><i class="bi bi-globe"></i> World Cup 2026</h6>
        <p>Host cities announced for North American tournament</p>
        <small><i class="bi bi-clock"></i> 1 day ago • <i class="bi bi-eye"></i> 1,245 views</small>
      </div>
    </div>
  </div>

  <footer class="footer bg-dark text-white py-4">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-4 mb-4 mb-md-0">
          <div class="d-flex align-items-center mb-3">
            <img src="/images/logo.png" alt="LiveScore Logo" width="200" class="me-2">
          </div>
          <p class="text-muted small">La mejor fuente de resultados deportivos en tiempo real.</p>
          <div class="social-icons">
            <a href="#" class="text-white me-3"><i class="bi bi-facebook"></i></a>
            <a href="#" class="text-white me-3"><i class="bi bi-twitter-x"></i></a>
            <a href="#" class="text-white me-3"><i class="bi bi-instagram"></i></a>
            <a href="#" class="text-white"><i class="bi bi-youtube"></i></a>
          </div>
        </div>

        <div class="col-md-2 mb-4 mb-md-0">
          <h6 class="text-success mb-3">Links</h6>
          <ul class="list-unstyled">
            <li class="mb-2"><a href="#" class="text-white text-decoration-none">Home</a></li>
            <li class="mb-2"><a href="#" class="text-white text-decoration-none">Football</a></li>
            <li class="mb-2"><a href="#" class="text-white text-decoration-none">Sports</a></li>
            <li><a href="#" class="text-white text-decoration-none">News</a></li>
          </ul>
        </div>

        <div class="col-md-3 mb-4 mb-md-0">
          <h6 class="text-success mb-3">Competitions</h6>
          <div class="row">
            <div class="col-6">
              <ul class="list-unstyled">
                <li class="mb-2"><a href="#" class="text-white text-decoration-none small">Premier League</a></li>
                <li class="mb-2"><a href="#" class="text-white text-decoration-none small">La Liga</a></li>
              </ul>
            </div>
            <div class="col-6">
              <ul class="list-unstyled">
                <li class="mb-2"><a href="#" class="text-white text-decoration-none small">Champions</a></li>
                <li><a href="#" class="text-white text-decoration-none small">Europa League</a></li>
              </ul>
            </div>
          </div>
        </div>


      </div>

      <div class="row mt-4 pt-3 border-top border-secondary">
        <div class="col-md-6 text-center text-md-start">
          <p class="small text-muted mb-0">© 2025 LiveScore. Todos los derechos reservados.</p>
        </div>
        <div class="col-md-6 text-center text-md-end">
          <a href="#" class="text-muted small text-decoration-none me-3">Términos</a>
          <a href="#" class="text-muted small text-decoration-none me-3">Privacidad</a>
        </div>
      </div>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="{{ asset('js/calendar.js') }}"></script>
  <script src="{{ asset('js/theme.js') }}"></script>
  <script src="{{ asset('js/futbol.js') }}"></script>
  <script src="{{ asset('js/tabs.js') }}"></script>
  <script src="{{ asset('js/profile.js') }}"></script>
</body>
</html>