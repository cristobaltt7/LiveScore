// Carga los equipos de La Liga desde la API de football-data y los muestra como tarjetas en la vista
document.addEventListener('DOMContentLoaded', async () => {
    const teamsContainer = document.getElementById('teamsContainer');

    const response = await fetch('https://api.football-data.org/v4/competitions/PD/teams', {
        headers: {
            'X-Auth-Token': document.querySelector('meta[name="football-token"]').content
        }
    });
    const data = await response.json();

    data.teams.forEach(team => {
        const card = document.createElement('div');
        card.classList.add('col');
        card.innerHTML = `
            <div class="card bg-dark text-white h-100 team-card" data-transfermarkt-id="${team.transfermarkt_id}">
                <img src="${team.crest}" class="card-img-top p-3" style="height: 100px; object-fit: contain;">
                <div class="card-body">
                    <h5 class="card-title">${team.name}</h5>
                    <a href="/club/${team.transfermarkt_id}/players" class="btn btn-outline-light mt-2">Ver plantilla</a>
                </div>
            </div>
        `;
        teamsContainer.appendChild(card);
    });
});
