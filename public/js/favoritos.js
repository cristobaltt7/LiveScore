// Filtra dinámicamente las tarjetas de equipos según el texto ingresado en el campo de búsqueda
document.addEventListener('DOMContentLoaded', function () {
    const input = document.getElementById('searchInput');
    const cards = document.querySelectorAll('.team-card-wrapper');

    input.addEventListener('input', function () {
        const query = this.value.toLowerCase();
        cards.forEach(card => {
            const name = card.querySelector('.team-name').textContent.toLowerCase();
            card.style.display = name.includes(query) ? 'block' : 'none';
        });
    });
});
