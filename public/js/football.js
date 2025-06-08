// nuevo football.js
document.addEventListener('DOMContentLoaded', function () {
    const teamSearch = document.getElementById('teamSearch');
    const searchResults = document.getElementById('searchResults');
    const selectedTeamContainer = document.getElementById('selectedTeamContainer');
    const popularTeams = document.getElementById('popularTeams');
    const favoriteBtn = document.getElementById('favoriteBtn');
    const statsContainer = document.getElementById('teamStats');
    let currentTeamId = null;
    let favorites = {};

    function loadFavorites() {
        fetch('/user/favorites')
            .then(response => response.json())
            .then(data => {
                favorites = data.favorites || {};
                updateFavoriteButton();
            });
    }

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
                    searchResults.innerHTML = '<div class="search-result-item">No teams found</div>';
                    searchResults.style.display = 'block';
                }
            });
    });

    function loadTeamDetails(teamId) {
        fetch(`/football/team/${teamId}`)
            .then(response => response.json())
            .then(team => {
                currentTeamId = team.team.id;

                document.getElementById('teamName').textContent = team.team.name;
                document.getElementById('teamLogo').src = team.team.logo;
                document.getElementById('teamCountry').textContent = team.team.country;
                document.getElementById('teamFounded').textContent = team.team.founded || 'Unknown';
                document.getElementById('teamStadium').textContent = team.venue.name;

                statsContainer.innerHTML = '';

                updateFavoriteButton();
                selectedTeamContainer.style.display = 'block';
                popularTeams.style.display = 'none';
                selectedTeamContainer.scrollIntoView({ behavior: 'smooth' });
            });
    }

    function updateFavoriteButton() {
        if (favorites[currentTeamId]) {
            favoriteBtn.innerHTML = '<i class="bi bi-heart-fill"></i> <span id="favoriteText">Remove from Favorites</span>';
            favoriteBtn.classList.add('active');
        } else {
            favoriteBtn.innerHTML = '<i class="bi bi-heart"></i> <span id="favoriteText">Add to Favorites</span>';
            favoriteBtn.classList.remove('active');
        }
    }

    favoriteBtn.addEventListener('click', function () {
        if (!currentTeamId) return;

        const teamName = document.getElementById('teamName').textContent;
        const teamLogo = document.getElementById('teamLogo').src;

        fetch('/football/toggle-favorite', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                team_id: currentTeamId,
                team_name: teamName,
                team_logo: teamLogo
            })
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    favorites = data.favorites;
                    updateFavoriteButton();
                }
            });
    });

    document.querySelectorAll('.team-card').forEach(card => {
        card.addEventListener('click', function () {
            const teamId = this.getAttribute('data-team-id');
            const clubId = this.getAttribute('data-club-id');
            statsContainer.innerHTML = '';

            if (teamId) loadTeamDetails(teamId);

            if (clubId) {
                fetch(`/transfermarkt/squad/${clubId}`)
                    .then(res => res.json())
                    .then(data => {
                        if (data.players && data.players.length > 0) {
                            renderFormation(data.players);
                        } else {
                            statsContainer.innerHTML += `<p class="text-white mt-3">No se encontró plantilla en Transfermarkt.</p>`;
                        }
                    })
                    .catch(err => {
                        console.error(err);
                        statsContainer.innerHTML += `<p class="text-white mt-3">Error al cargar plantilla de Transfermarkt.</p>`;
                    });
            }
        });
    });

    loadFavorites();
});
