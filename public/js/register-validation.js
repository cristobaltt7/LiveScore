// Controla la visibilidad de contraseñas, valida el formulario de registro y muestra errores personalizados si hay campos incorrectos
document.addEventListener("DOMContentLoaded", function () {

  // Activa el botón de mostrar/ocultar contraseña al hacer clic en el ícono del ojo
  document.querySelectorAll(".form-icon").forEach(function (icon) {
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
  });

  const form = document.querySelector("form");
  if (!form) return;

  // Muestra un mensaje de error debajo del campo correspondiente
  function showError(input, message) {
    let error = input.nextElementSibling;
    if (!error || !error.classList.contains("error-message")) {
      error = document.createElement("div");
      error.classList.add("error-message");
      input.insertAdjacentElement("afterend", error);
    }
    error.textContent = message;
  }

  // Elimina todos los mensajes de error del formulario
  function clearErrors(form) {
    form.querySelectorAll(".error-message").forEach(el => el.remove());
  }

  form.addEventListener("submit", function (event) {
    clearErrors(form);
    let valid = true;

    const nameInput = form.querySelector('input[name="name"]');
    const emailInput = form.querySelector('input[name="email"]');
    const passwordInput = form.querySelector('input[name="password"]');
    const confirmInput = form.querySelector('input[name="password_confirmation"]');

    if (!nameInput.value.trim()) {
      showError(nameInput, "Por favor, introduce tu correo.");
      nameInput.focus();
      valid = false;
    }

    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailInput.value.trim() || !emailRegex.test(emailInput.value.trim())) {
      showError(emailInput, "Por favor, introduce una dirección de correo electrónico válida.");
      if (valid) emailInput.focus();
      valid = false;
    }

    if (!passwordInput.value) {
      showError(passwordInput, "Por favor, introduce tu contraseña.");
      if (valid) passwordInput.focus();
      valid = false;
    } else if (passwordInput.value.length < 8) {
      showError(passwordInput, "La contraseña debe tener al menos 8 caracteres.");
      if (valid) passwordInput.focus();
      valid = false;
    } else {
      const password = passwordInput.value;
      const reUpper = /[A-Z]/;
      const reLower = /[a-z]/;
      const reNumber = /[0-9]/;
      const reSpecial = /[!@#$%^&*(),.?":{}|<>]/;

      if (!reUpper.test(password)) {
        showError(passwordInput, "La contraseña debe contener al menos una letra mayúscula.");
        if (valid) passwordInput.focus();
        valid = false;
      }
      if (!reLower.test(password)) {
        showError(passwordInput, "La contraseña debe contener al menos una letra minúscula.");
        if (valid) passwordInput.focus();
        valid = false;
      }
      if (!reNumber.test(password)) {
        showError(passwordInput, "La contraseña debe contener al menos un número.");
        if (valid) passwordInput.focus();
        valid = false;
      }
      if (!reSpecial.test(password)) {
        showError(passwordInput, "La contraseña debe contener al menos un carácter especial (por ejemplo, !@#$%^&*).");
        if (valid) passwordInput.focus();
        valid = false;
      }
    }

    if (confirmInput.value !== passwordInput.value) {
      showError(confirmInput, "Las contraseñas no coinciden.");
      if (valid) confirmInput.focus();
      valid = false;
    }

    if (!valid) event.preventDefault();
  });
});
