<div class="sidebar">
    <div class="sidebar-content">
      <div class="logo">
        <img src="/images/logo.png" alt="LiveScore Logo">
      </div>
      <input type="text" class="form-control form-control-sm" placeholder="🔍 Search...">
      
      <a href="/" class="active"><i class="bi bi-house-door"></i> <span>Home</span></a>
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