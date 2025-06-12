// Valida el formulario de cambio de contraseña antes de enviarlo, mostrando errores personalizados si no se cumplen los requisitos
document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('form[action*="password.update"]');

    if (form) {
        form.addEventListener('submit', function (e) {
            const oldAlert = form.previousElementSibling;
            if (oldAlert && oldAlert.classList.contains('alert')) {
                oldAlert.remove();
            }

            const currentPassword = form.querySelector('input[name="current_password"]').value.trim();
            const newPassword = form.querySelector('input[name="password"]').value.trim();
            const confirmPassword = form.querySelector('input[name="password_confirmation"]').value.trim();

            const errors = [];

            if (!currentPassword) {
                errors.push("Debes introducir tu contraseña actual.");
            }

            if (newPassword.length < 8) {
                errors.push("La nueva contraseña debe tener al menos 8 caracteres.");
            }

            if (!/[a-z]/.test(newPassword) || !/[A-Z]/.test(newPassword)) {
                errors.push("La nueva contraseña debe contener mayúsculas y minúsculas.");
            }

            if (!/\d/.test(newPassword)) {
                errors.push("La nueva contraseña debe contener al menos un número.");
            }

            if (!/[!@#$%^&*(),.?\":{}|<>]/.test(newPassword)) {
                errors.push("La nueva contraseña debe contener al menos un símbolo.");
            }

            if (newPassword !== confirmPassword) {
                errors.push("Las nuevas contraseñas no coinciden.");
            }

            if (errors.length > 0) {
                e.preventDefault();

                const errorHtml = `
                    <div class="alert alert-danger mt-3" role="alert">
                        <ul class="mb-0">
                            ${errors.map(error => `<li>${error}</li>`).join('')}
                        </ul>
                    </div>
                `;
                form.insertAdjacentHTML('beforebegin', errorHtml);
            }
        });
    }
});
