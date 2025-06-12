// Cambia el tema del sitio entre claro y oscuro, y lo guarda en localStorage
function toggleTheme(theme) {
  if (theme === 'light') {
    document.body.classList.add('light-mode');
    localStorage.setItem('theme', 'light');
  } else {
    document.body.classList.remove('light-mode');
    localStorage.setItem('theme', 'dark');
  }
}

// Al cargar la página, aplica el tema guardado y activa los botones de cambio de tema
document.addEventListener('DOMContentLoaded', () => {
  const savedTheme = localStorage.getItem('theme') || 'dark';
  toggleTheme(savedTheme);
  document.getElementById('lightModeBtn')?.addEventListener('click', () => toggleTheme('light'));
  document.getElementById('darkModeBtn')?.addEventListener('click', () => toggleTheme('dark'));
});
