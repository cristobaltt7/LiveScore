function toggleTheme(theme) {
  if (theme === 'light') {
    document.body.classList.add('light-mode');
    localStorage.setItem('theme', 'light');
  } else {
    document.body.classList.remove('light-mode');
    localStorage.setItem('theme', 'dark');
  }
}

document.addEventListener('DOMContentLoaded', () => {
  const savedTheme = localStorage.getItem('theme') || 'dark';
  toggleTheme(savedTheme);
  document.getElementById('lightModeBtn')?.addEventListener('click', () => toggleTheme('light'));
  document.getElementById('darkModeBtn')?.addEventListener('click', () => toggleTheme('dark'));
});
