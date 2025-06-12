// Filtrar la tabla de clasificación (si hay tipos por dataset)
function filtrarTabla(tipo) {
    const rows = document.querySelectorAll('#tabla-clasificacion tbody tr');
    rows.forEach(row => {
        if (tipo === 'all' || row.dataset.type === tipo) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
}
