// Detecta cuando el usuario presiona "Enter" en el buscador del sidebar y redirige a la sección correspondiente según el término escrito
document.addEventListener('DOMContentLoaded', function () {
  const input = document.getElementById('sidebarSearchInput');
  if (!input) return;

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
        window.location.href = '/player-statistics';
      } else if (value === 'home') {
        window.location.href = '/';
      } else {
        alert('No se encontró ninguna sección con ese nombre.');
      }
    }
  });
});
