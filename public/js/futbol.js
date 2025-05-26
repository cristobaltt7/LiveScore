document.addEventListener('DOMContentLoaded', () => {
    $apiToken = env('FOOTBALL_DATA_API_TOKEN');

  fetch('https://api.football-data.org/v4/matches?status=LIVE', {
    headers: {
      'X-Auth-Token': apiToken
    }
  })
    .then(response => {
      if (!response.ok) {
        throw new Error('Error en la API: ' + response.status);
      }
      return response.json();
    })
    .then(data => {
      const matches = data.matches || [];
      const container = document.querySelector('.match-card');
      container.innerHTML = ''; // Limpia contenido previo

      if (matches.length === 0) {
        container.innerHTML = '<p>No hay partidos en vivo actualmente.</p>';
        return;
      }

      matches.forEach(match => {
        const home = match.homeTeam?.name || 'Local';
        const away = match.awayTeam?.name || 'Visitante';

        // En football-data.org los goles suelen estar en score.fullTime
        const goalsHome = match.score?.fullTime?.home ?? 0;
        const goalsAway = match.score?.fullTime?.away ?? 0;
        const status = match.status; // debería ser LIVE

        const row = document.createElement('div');
        row.classList.add('match-row');

        const liveIcon = (status === 'LIVE') 
          ? '<i class="bi bi-circle-fill text-success"></i> Live' 
          : '<i class="bi bi-clock"></i>';

        row.innerHTML = `
          <span>${liveIcon}</span>
          <span>${home}</span>
          <strong>${goalsHome} - ${goalsAway}</strong>
          <span>${away}</span>
        `;

        container.appendChild(row);
      });
    })
    .catch(err => {
      console.error('Error cargando partidos en vivo:', err);
      const container = document.querySelector('.match-card');
      container.innerHTML = '<p>Error al cargar los partidos.</p>';
    });
});
