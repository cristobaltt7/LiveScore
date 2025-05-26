@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/styles.css') }}">

<div class="profile-page">
  <div class="profile-header">
    <div class="cover-photo" style="background-image: url('/images/profile-cover.jpg');"></div>
    <div class="profile-info">
      <div class="avatar">
        <img src="{{ Auth::user()->avatar ?? '/images/avatar.png' }}" alt="Avatar">

      </div>
      <h1 class="text-white">{{ Auth::user()->name }}</h1>
      <p class="text-white">{{ Auth::user()->email }}</p>
    </div>
  </div>

  <div class="profile-content">
    <div class="row">
      <div class="col-md-4">
        <div class="card profile-card">
          <div class="card-header">
            <h5 class="text-white"><i class="bi bi-person-badge"></i> Información Personal</h5>
          </div>
          <div class="card-body">
            <ul class="profile-details">
              <li>
                <i class="bi bi-envelope text-white"></i>
                <span class="text-white">{{ Auth::user()->email }}</span>
              </li>
              <li>
                <i class="bi bi-calendar text-white"></i>
                <span class="text-white">Miembro desde {{ Auth::user()->created_at->format('d M Y') }}</span>
              </li>

              <li>
                <i class="bi bi-heart text-white"></i>
                <span class="text-white">Equipo favorito:</span>
              </li>
            </ul>
            
            <button class="btn btn-primary btn-edit-profile">
              <i class="bi bi-pencil text-white"></i> <span class="text-white">Editar Perfil</span>
            </button>
          </div>
        </div>
        
        <div class="card profile-card mt-3">
          <div class="card-header">
            <h5 class="text-white"><i class="bi bi-shield-lock"></i> Seguridad</h5>
          </div>
          <div class="card-body">
            <button class="btn btn-outline-secondary btn-block btn-change-password">
              <i class="bi bi-key text-white"></i> <span class="text-white">Cambiar Contraseña</span>
            </button>
          </div>
        </div>
      </div>
     
        
        <div class="card profile-card mt-3">
          <div class="card-header">
            <h5 class="text-white"><i class="bi bi-heart"></i> Equipos Favoritos</h5>
          </div>
          <div class="card-body">
            <div class="favorite-teams">
              <div class="team-item">
                <img src="/images/teams/real-madrid.png" alt="Real Madrid">
                <span class="text-white">Real Madrid</span>
              </div>
              <button class="btn btn-outline-primary btn-add-team">
                <i class="bi bi-plus text-white"></i> <span class="text-white">Añadir equipo</span>
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="editProfileModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content bg-dark text-white">
      <div class="modal-header border-secondary">
        <h5 class="modal-title text-white">Editar Perfil</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="profileForm">
          <div class="mb-3">
            <label for="name" class="form-label text-white">Nombre</label>
            <input type="text" class="form-control bg-dark text-white border-secondary" id="name" value="{{ Auth::user()->name }}">
          </div>

        </form>
      </div>
      <div class="modal-footer border-secondary">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary" id="saveProfile">Guardar Cambios</button>
      </div>
    </div>
  </div>
</div>
@endsection