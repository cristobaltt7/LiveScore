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
      
      <a href="/followed-team"><i class="bi bi-heart"></i> <span>Followed Team</span></a>
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
      
      <div class="setting-item">
        <label><i class="bi bi-translate"></i> Language</label>
<select class="form-select form-select-sm" style="width: 100px;" onchange="doTranslate(this)">
  <option value="es">Español</option>
  <option value="en">English</option>
  <option value="fr">Français</option>
  <option value="de">Deutsch</option>
  <option value="it">Italiano</option>
  <option value="pt">Português</option>
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
