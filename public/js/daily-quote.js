document.addEventListener('DOMContentLoaded', function () {
  const frases = [
    "La disciplina tarde o temprano vencerá al talento.",
    "No cuentes los días, haz que los días cuenten. – Muhammad Ali",
    "El fútbol es simple, pero es difícil jugar simple. – Cruyff",
    "Si no crees que eres el mejor, nunca lo lograrás. – Cristiano Ronaldo",
    "Prefiero perder un partido por nueve goles que nueve partidos por un gol. – Vujadin Boskov"
  ];
  const quote = frases[Math.floor(Math.random() * frases.length)];
  const container = document.getElementById('dailyQuote');
  if (container) container.innerText = quote;
});
