document.addEventListener('DOMContentLoaded', function () {
    const teamSearch = document.getElementById('teamSearch');
    const searchResults = document.getElementById('searchResults');
    const selectedTeamContainer = document.getElementById('selectedTeamContainer');
    const popularTeams = document.getElementById('popularTeams');

    // Cargar y mostrar los detalles de un equipo por su ID (Football-Data)
    function loadTeamDetails(teamId) {
        fetch(`/football/team/${teamId}`)
            .then(response => response.json())
            .then(team => {
                document.getElementById('teamName').textContent = team.team.name;
                document.getElementById('teamLogo').src = team.team.logo;
                document.getElementById('teamCountry').textContent = team.team.country;
                document.getElementById('teamFounded').textContent = team.team.founded || 'Desconocido';
                document.getElementById('teamStadium').textContent = team.venue.name;

                selectedTeamContainer.style.display = 'block';
                popularTeams.style.display = 'none';
                selectedTeamContainer.scrollIntoView({ behavior: 'smooth' });
            });
    }

    // Buscar equipos al escribir (mínimo 3 caracteres)
    teamSearch.addEventListener('input', function () {
        const query = this.value.trim();
        if (query.length < 3) {
            searchResults.style.display = 'none';
            return;
        }

        fetch(`/football/search?query=${encodeURIComponent(query)}`)
            .then(response => response.json())
            .then(teams => {
                if (teams.length > 0) {
                    searchResults.innerHTML = teams.map(team => `
                        <div class="search-result-item" data-team-id="${team.team.id}">
                            <img src="${team.team.logo}" alt="${team.team.name}">
                            <span>${team.team.name}</span>
                        </div>
                    `).join('');
                    searchResults.style.display = 'block';

                    document.querySelectorAll('.search-result-item').forEach(item => {
                        item.addEventListener('click', function () {
                            const teamId = this.getAttribute('data-team-id');
                            loadTeamDetails(teamId);
                            teamSearch.value = '';
                            searchResults.style.display = 'none';
                        });
                    });
                } else {
                    searchResults.innerHTML = '<div class="search-result-item">No se encontraron equipos</div>';
                    searchResults.style.display = 'block';
                }
            });
    });

    // Al hacer clic en una tarjeta de equipo
    document.querySelectorAll('.team-card').forEach(card => {
        card.addEventListener('click', function (e) {

            if (e.target.classList.contains('favorite-icon')) return;

            const teamId = this.getAttribute('data-team-id');
            const clubId = this.getAttribute('data-club-id');

            if (teamId) loadTeamDetails(teamId);

            if (clubId) {
                fetch(`/transfermarkt/squad/${clubId}`)
                    .then(res => {
                        if (!res.ok) {
                            throw new Error("Error al cargar la plantilla");
                        }
                        return res.json();
                    })
                    .then(data => {
                        if (data.players && data.players.length > 0) {
                            renderFormation(data.players);
                        } else {
                            mostrarMensajeError("La API no está disponible en estos momentos.");
                        }
                    })
                    .catch(() => {
                        mostrarMensajeError("La API no está disponible en estos momentos.");
                    });

                // Cargar perfil del club desde Transfermarkt
                fetch(`https://transfermarkt-api.fly.dev/clubs/${clubId}/profile`)
                    .then(res => res.json())
                    .then(data => {
                        if (data) {
                            const club = data;
                            document.getElementById('teamName').textContent = club.name || 'Desconocido';
                            document.getElementById('teamLogo').src = club.image || '';
                            document.getElementById('teamCountry').textContent = club.addressLine3 || 'Desconocido';
                            document.getElementById('teamFounded').textContent = club.foundedOn || 'Desconocido';
                            document.getElementById('teamStadium').textContent = club.stadiumName || 'Desconocido';
                        }
                    });
            }
        });
    });

    // Marcar/desmarcar un equipo como favorito al hacer clic en el ícono del corazón
    document.addEventListener('click', async function (e) {
        if (e.target.classList.contains('favorite-icon')) {
            e.stopPropagation();
            const icon = e.target;
            const card = icon.closest('.team-card');

            const footballId = card.dataset.teamId;
            const transfermarktId = card.dataset.transfermarktId;
            const teamName = card.dataset.teamName;
            const teamLogo = card.dataset.teamLogo;

            try {
                const res = await fetch('/favorite/toggle', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        football_data_id: footballId,
                        transfermarkt_id: card.dataset.transfermarktId,
                        team_name: teamName,
                        team_logo: teamLogo
                    })

                });

                const data = await res.json();

                if (data.favorito) {
                    icon.classList.remove('bi-heart', 'text-white');
                    icon.classList.add('bi-heart-fill', 'text-danger');
                } else {
                    icon.classList.remove('bi-heart-fill', 'text-danger');
                    icon.classList.add('bi-heart', 'text-white');
                }
            } catch (err) {
                console.error('Error al guardar favorito:', err);
            }
        }
    });

    // Si hay un equipo guardado en localStorage para enfocar automáticamente
    const scrollToTeamId = localStorage.getItem('scrollToTeamId');
    if (scrollToTeamId) {
        const teamCard = document.querySelector(`.team-card[data-team-id='${scrollToTeamId}']`);
        if (teamCard) {
            teamCard.click();
        } else {
            loadTeamDetails(scrollToTeamId);
        }
        localStorage.removeItem('scrollToTeamId');
    }
});

// Mostrar un mensaje de error en el contenedor de formación o equipo seleccionado
function mostrarMensajeError(mensaje) {
    const container = document.getElementById('formationContainer') || document.getElementById('selectedTeamContainer');
    if (container) {
        container.innerHTML = `<div class="alert alert-warning text-center">${mensaje}</div>`;
    }
}
