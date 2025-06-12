// Carga la plantilla del equipo desde el servidor y la distribuye por posiciones en el campo
async function loadSquad() {
    try {
        const res = await fetch(`/football/team/${teamId}/squad`);
        if (!res.ok) throw new Error('No se pudo cargar la plantilla');
        const data = await res.json();

        ['goalkeepers', 'defenders', 'midfielders', 'forwards'].forEach(pos => {
            document.querySelector(`.${pos}`).innerHTML = '';
        });

        for (const position in data.squad) {
            data.squad[position].forEach(player => {
                addPlayer(position, player);
            });
        }

    } catch (error) {
        alert(error.message);
    }
}

// Crea y añade un jugador en la posición indicada dentro del campo
function addPlayer(positionClass, player) {
    const container = document.querySelector(`.${positionClass}`);
    const div = document.createElement('div');
    div.classList.add('player');
    div.textContent = player.name || 'Jugador';
    container.appendChild(div);
}

document.addEventListener('DOMContentLoaded', loadSquad);
