// Frase del día aleatoria
document.addEventListener('DOMContentLoaded', function () {
  const frases = [
    "La disciplina tarde o temprano vencerá al talento.",
    "No cuentes los días, haz que los días cuenten. – Muhammad Ali",
    "El fútbol es simple, pero es difícil jugar simple. – Cruyff",
    "Si no crees que eres el mejor, nunca lo lograrás. – Cristiano Ronaldo",
    "Prefiero perder un partido por nueve goles que nueve partidos por un gol. – Vujadin Boskov",
    "El talento depende de la inspiración, pero el esfuerzo depende de cada uno. – Pep Guardiola",
    "No hay presión cuando haces lo que amas. – Neymar Jr.",
    "Ganar sin honor es peor que perder. – Sócrates (jugador)",
    "El éxito no es un accidente. Es trabajo duro, perseverancia, aprendizaje y amor por lo que haces. – Pelé",
    "La práctica no hace la perfección. La práctica perfecta hace la perfección. – Vince Lombardi",
    "Cada entrenamiento, cada partido, es una oportunidad para mejorar. – Lionel Messi",
    "No me arrepiento de los errores, porque me enseñaron lo que no debo hacer. – Ronaldinho",
    "El fútbol no es cuestión de vida o muerte, ¡es mucho más que eso! – Bill Shankly",
    "Nunca subestimes a alguien con pasión por lo que hace.",
    "Un equipo no es un grupo de personas que trabajan juntas, es un grupo que confía entre sí."
  ];
  const aleatoria = frases[Math.floor(Math.random() * frases.length)];
  const quoteEl = document.getElementById('dailyQuote');
  if (quoteEl) quoteEl.innerText = aleatoria;
});

// Buscador del sidebar
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
