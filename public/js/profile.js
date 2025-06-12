document.addEventListener('DOMContentLoaded', function() {
  // Redirección al hacer clic en el perfil del sidebar
  const profileButton = document.getElementById('profileButton');
  if (profileButton) {
    profileButton.addEventListener('click', function(e) {
      if (!e.target.closest('#logoutButton')) {
        window.location.href = '/profile';
      }
    });
  }

  // Manejar el logout
  const logoutButton = document.getElementById('logoutButton');
  if (logoutButton) {
    logoutButton.addEventListener('click', function(e) {
      e.preventDefault();
      document.getElementById('logoutForm').submit();
    });
  }

  // Modal de edición de perfil
  const editProfileModal = new bootstrap.Modal(document.getElementById('editProfileModal'));
  const btnEditProfile = document.querySelector('.btn-edit-profile');
  
  if (btnEditProfile) {
    btnEditProfile.addEventListener('click', function() {
      editProfileModal.show();
    });
  }

});