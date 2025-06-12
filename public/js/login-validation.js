// Maneja la visibilidad de la contraseña, validación del formulario de login y muestra errores personalizados del backend
document.addEventListener("DOMContentLoaded", function () {
  const icon = document.querySelector(".form-icon");
  if (icon) {
    icon.addEventListener("click", function () {
      const input = this.previousElementSibling;
      if (input.type === "password") {
        input.type = "text";
        this.firstElementChild.classList.remove("fa-eye-slash");
        this.firstElementChild.classList.add("fa-eye");
      } else {
        input.type = "password";
        this.firstElementChild.classList.remove("fa-eye");
        this.firstElementChild.classList.add("fa-eye-slash");
      }
    });
  }

  const form = document.querySelector("form");
  if (!form) return;

  // Funcion que muestra mensajes de error
  function showError(input, message) {
    let error = input.nextElementSibling;
    if (!error || !error.classList.contains("error-message")) {
      error = document.createElement("div");
      error.classList.add("error-message");
      input.insertAdjacentElement("afterend", error);
    }
    error.textContent = message;
  }

  // Funcion para limpiar los mensajes de error
  function clearErrors(form) {
    form.querySelectorAll(".error-message").forEach(el => el.remove());
  }

  form.addEventListener("submit", function (event) {
    clearErrors(form);
    let valid = true;

    const emailInput = form.querySelector('input[name="email"]');
    const passwordInput = form.querySelector('input[name="password"]');

    if (!emailInput.value.trim()) {
      showError(emailInput, "Por favor, introduce tu correo.");
      emailInput.focus();
      valid = false;
    }

    if (!passwordInput.value) {
      showError(passwordInput, "Por favor, introduce tu contraseña.");
      if (valid) passwordInput.focus();
      valid = false;
    }

    if (!valid) event.preventDefault();
  });

  const backendError = document.querySelector('[data-login-error]');
  if (backendError) {
    const passwordInput = form.querySelector('input[name="password"]');
    showError(passwordInput, backendError.dataset.loginError);
  }

});

// Funcion para mostrar la contraseña
function togglePasswordVisibility() {
  const passwordField = document.getElementById('passwordField');
  const toggleIcon = document.getElementById('toggleIcon');

  if (passwordField.type === 'password') {
    passwordField.type = 'text';
    toggleIcon.classList.remove('fa-eye');
    toggleIcon.classList.add('fa-eye-slash');
  } else {
    passwordField.type = 'password';
    toggleIcon.classList.remove('fa-eye-slash');
    toggleIcon.classList.add('fa-eye');
  }
}