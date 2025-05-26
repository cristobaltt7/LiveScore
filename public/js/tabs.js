document.addEventListener('DOMContentLoaded', () => {
  document.querySelectorAll('.date-tab').forEach(tab => {
    tab.addEventListener('click', () => {
      document.querySelectorAll('.date-tab').forEach(t => t.classList.remove('active'));
      tab.classList.add('active');
    });
  });

  // Asegurar texto blanco en inputs y textos grises
  document.querySelectorAll('input[type="text"], .text-muted').forEach(el => {
    el.style.color = '#fff';
  });
});
