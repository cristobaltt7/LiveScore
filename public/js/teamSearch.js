// Filtra las tarjetas de equipos en tiempo real según el texto ingresado en el buscador
document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('teamSearch');
    const teamCards = document.querySelectorAll('.team-card');

    searchInput.addEventListener('input', function () {
        const query = this.value.toLowerCase();
        teamCards.forEach(card => {
            const name = card.dataset.teamName.toLowerCase();
            const visible = name.includes(query);
            card.parentElement.style.display = visible ? 'block' : 'none';
        });
    });
});
