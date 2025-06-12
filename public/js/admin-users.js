// Mostrar campo de confirmación al pulsar "Eliminar"
document.querySelectorAll('.btn-mostrar-confirm').forEach(btn => {
    btn.addEventListener('click', () => {
        const form = btn.closest('form');
        const confirmDiv = form.querySelector('.confirmar-eliminar');
        confirmDiv.style.display = 'block';
        btn.style.display = 'none';
    });
});

// Validación para confirmar eliminación
function confirmarEliminacion(form) {
    const input = form.querySelector('input[name="confirm"]');
    const errorDiv = form.querySelector('.error-confirm');

    if (input.value !== 'ELIMINAR') {
        errorDiv.textContent = 'Debes escribir "ELIMINAR" en mayúsculas para confirmar.';
        return false;
    }
    return true;
}

// Filtro de búsqueda en la tabla
document.getElementById('searchInput').addEventListener('input', function () {
    const filtro = this.value.toLowerCase();
    const filas = document.querySelectorAll('#usersTable tbody tr');

    filas.forEach(fila => {
        const nombre = fila.querySelector('.nombre').textContent.toLowerCase();
        fila.style.display = nombre.includes(filtro) ? '' : 'none';
    });
});
