// Funciones generales de la aplicación
document.addEventListener('DOMContentLoaded', function() {
  // Pestañas de fecha
  document.querySelectorAll('.date-tab').forEach(tab => {
    tab.addEventListener('click', () => {
      document.querySelectorAll('.date-tab').forEach(t => t.classList.remove('active'));
      tab.classList.add('active');
    });
  });

  // Botones de desplazamiento de fechas
  const scrollLeft = document.getElementById('scrollLeft');
  const scrollRight = document.getElementById('scrollRight');
  const dateTabsScroll = document.getElementById('dateTabsScroll');

  if (scrollLeft && scrollRight && dateTabsScroll) {
    scrollLeft.addEventListener('click', () => {
      dateTabsScroll.scrollBy({ left: -200, behavior: 'smooth' });
    });

    scrollRight.addEventListener('click', () => {
      dateTabsScroll.scrollBy({ left: 200, behavior: 'smooth' });
    });
  }
});