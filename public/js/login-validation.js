document.addEventListener("DOMContentLoaded", function () {
  // Show/hide password in login
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

  // Function to show error message
  function showError(input, message) {
    // Check if error message already exists
    let error = input.nextElementSibling;
    if (!error || !error.classList.contains("error-message")) {
      error = document.createElement("div");
      error.classList.add("error-message");
      input.insertAdjacentElement("afterend", error);
    }
    error.textContent = message;
  }

  // Function to clear error messages
  function clearErrors(form) {
    form.querySelectorAll(".error-message").forEach(el => el.remove());
  }

  form.addEventListener("submit", function (event) {
    clearErrors(form);
    let valid = true;

    const emailInput = form.querySelector('input[name="email"]');
    const passwordInput = form.querySelector('input[name="password"]');

    if (!emailInput.value.trim()) {
      showError(emailInput, "Please enter your username or email.");
      emailInput.focus();
      valid = false;
    }

    if (!passwordInput.value) {
      showError(passwordInput, "Please enter your password.");
      if (valid) passwordInput.focus();
      valid = false;
    }

    if (!valid) event.preventDefault();
  });
});
