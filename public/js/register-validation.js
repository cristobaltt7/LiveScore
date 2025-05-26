document.addEventListener("DOMContentLoaded", function () {
  // Show/hide password in register (all password fields)
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

  function showError(input, message) {
    let error = input.nextElementSibling;
    if (!error || !error.classList.contains("error-message")) {
      error = document.createElement("div");
      error.classList.add("error-message");
      input.insertAdjacentElement("afterend", error);
    }
    error.textContent = message;
  }

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
      showError(nameInput, "Please enter your username.");
      nameInput.focus();
      valid = false;
    }

    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailInput.value.trim() || !emailRegex.test(emailInput.value.trim())) {
      showError(emailInput, "Please enter a valid email address.");
      if (valid) emailInput.focus();
      valid = false;
    }

    if (!passwordInput.value) {
      showError(passwordInput, "Please enter a password.");
      if (valid) passwordInput.focus();
      valid = false;
    } else if (passwordInput.value.length < 8) {
      showError(passwordInput, "Password must be at least 8 characters long.");
      if (valid) passwordInput.focus();
      valid = false;
    } else {
      const password = passwordInput.value;
      const reUpper = /[A-Z]/;
      const reLower = /[a-z]/;
      const reNumber = /[0-9]/;
      const reSpecial = /[!@#$%^&*(),.?":{}|<>]/;

      if (!reUpper.test(password)) {
        showError(passwordInput, "Password must contain at least one uppercase letter.");
        if (valid) passwordInput.focus();
        valid = false;
      }
      if (!reLower.test(password)) {
        showError(passwordInput, "Password must contain at least one lowercase letter.");
        if (valid) passwordInput.focus();
        valid = false;
      }
      if (!reNumber.test(password)) {
        showError(passwordInput, "Password must contain at least one number.");
        if (valid) passwordInput.focus();
        valid = false;
      }
      if (!reSpecial.test(password)) {
        showError(passwordInput, "Password must contain at least one special character (e.g. !@#$%^&*).");
        if (valid) passwordInput.focus();
        valid = false;
      }
    }

    if (confirmInput.value !== passwordInput.value) {
      showError(confirmInput, "Passwords do not match.");
      if (valid) confirmInput.focus();
      valid = false;
    }

    if (!valid) event.preventDefault();
  });
});
