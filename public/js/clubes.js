// Filtra las tarjetas de clubes en tiempo real según lo que se escribe en el campo de búsqueda
document.addEventListener('DOMContentLoaded', () => {
    const input = document.getElementById('clubSearch');
    const cards = document.querySelectorAll('.club-card');

    input.addEventListener('input', function () {
        const search = this.value.toLowerCase();
        cards.forEach(card => {
            const name = card.getAttribute('data-name');
            card.style.display = name.includes(search) ? 'block' : 'none';
        });
    });
});
