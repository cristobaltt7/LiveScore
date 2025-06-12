// Restaura la vista principal ocultando los detalles del equipo y mostrando la lista de equipos populares
function volverALista() {
    document.getElementById('selectedTeamContainer').style.display = 'none';
    document.getElementById('popularTeams').style.display = 'block';
    document.getElementById('searchContainer').style.display = 'block';
    document.getElementById('teamStats').innerHTML = '';
    document.getElementById('formationPlayers').innerHTML = '';
    document.getElementById('fullSquadContainer').innerHTML = '';
    document.getElementById('lineupSelector').innerHTML = '';
}
