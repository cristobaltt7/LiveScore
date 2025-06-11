@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <div class="container py-5 text-white">
        <h2 class="mb-4 text-center"><i class="bi bi-person-circle"></i> Mi perfil</h2>

        @if (session('status') === 'password-updated')
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle-fill"></i> Contraseña actualizada correctamente.
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
            </div>
        @endif


        <!-- Información general -->
        <div class="card bg-dark mb-4">
            <div class="card-body text-white">
                <h5><i class="bi bi-info-circle"></i> Información general</h5>
                <p><strong>Nombre:</strong> {{ auth()->user()->name }}</p>
                <p><strong>Email:</strong> {{ auth()->user()->email }}</p>
                <p><strong>Miembro desde:</strong> {{ auth()->user()->created_at->format('d/m/Y') }}</p>
            </div>
        </div>

        <!-- Equipos favoritos -->
        @php
            $favorites = json_decode(auth()->user()->favorite_teams ?? '{}', true);
        @endphp

        @if (!empty($favorites))
            <div class="card bg-dark mb-4">
                <div class="card-body text-white">
                    <h5><i class="bi bi-heart-fill text-danger"></i> Equipos favoritos</h5>
                    <div class="row mt-3">
                        @foreach ($favorites as $team)
                            <div class="col-6 col-md-3 col-lg-2 text-center mb-4">
                                <div class="p-2 border rounded bg-secondary">
                                    <img src="{{ $team['logo'] }}" alt="Escudo" class="img-fluid mb-2" style="max-height: 60px;">
                                    <div class="fw-semibold">{{ $team['name'] }}</div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif


        <!-- Formulario para editar perfil -->
        <div class="card bg-dark mb-4">
            <div class="card-body text-white">
                <h5><i class="bi bi-pencil-square"></i> Editar perfil</h5>
                <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Nombre</label>
                            <input type="text" name="name" class="form-control bg-secondary text-white border-0"
                                value="{{ old('name', auth()->user()->name) }}" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control bg-secondary text-white border-0"
                                value="{{ old('email', auth()->user()->email) }}" required>
                        </div>
                    </div>
                    
                    <button type="submit" class="btn btn-success w-100"><i class="bi bi-save"></i> Guardar cambios</button>
                </form>
            </div>
        </div>



        <!-- Cambio de contraseña -->
        <div class="card bg-dark mb-4">
            <div class="card-body text-white">
                <h5><i class="bi bi-lock-fill"></i> Cambiar contraseña</h5>
                @if ($errors->has('current_password'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="bi bi-exclamation-triangle-fill"></i> {{ $errors->first('current_password') }}
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <form method="POST" action="{{ route('password.update') }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label>Contraseña actual</label>
                        <input type="password" name="current_password" class="form-control bg-secondary text-white border-0"
                            required>
                    </div>
                    <div class="mb-3">
                        <label>Nueva contraseña</label>
                        <input type="password" name="password" class="form-control bg-secondary text-white border-0"
                            required>
                    </div>
                    <div class="mb-3">
                        <label>Confirmar nueva contraseña</label>
                        <input type="password" name="password_confirmation"
                            class="form-control bg-secondary text-white border-0" required>
                    </div>

                    <button type="submit" class="btn btn-primary w-100"><i class="bi bi-key"></i> Cambiar
                        contraseña</button>
                </form>
            </div>
        </div>

        <!-- Botón eliminar cuenta -->
        <div class="text-center mb-4">
            <button class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteAccountModal">
                <i class="bi bi-trash"></i> Eliminar cuenta
            </button>
        </div>

        <!-- Modal eliminar cuenta -->
        <div class="modal fade" id="deleteAccountModal" tabindex="-1">
            <div class="modal-dialog">
                <form method="POST" action="{{ route('profile.destroy') }}">
                    @csrf
                    @method('DELETE')

                    <div class="modal-content bg-dark text-white">
                        <div class="modal-header">
                            <h5 class="modal-title">¿Estás seguro?</h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            Para eliminar tu cuenta, introduce tu contraseña:
                            <input type="password" name="password"
                                class="form-control mt-2 bg-secondary text-white border-0" required>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-danger">Eliminar cuenta</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        @if(auth()->user()->role === 'admin')
            <hr>
            <div class="admin-section mt-3">
                <h5>Administración</h5>
                <a href="{{ route('admin.users') }}" class="btn btn-outline-light btn-sm mt-2">
                    <i class="bi bi-people"></i> Ver usuarios
                </a>
            </div>
        @endif



    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.querySelector('form[action="{{ route('password.update') }}"]');

            if (form) {
                form.addEventListener('submit', function (e) {
                    // Elimina alertas anteriores si existen
                    const oldAlert = form.previousElementSibling;
                    if (oldAlert && oldAlert.classList.contains('alert')) {
                        oldAlert.remove();
                    }

                    const currentPassword = form.querySelector('input[name="current_password"]').value.trim();
                    const newPassword = form.querySelector('input[name="password"]').value.trim();
                    const confirmPassword = form.querySelector('input[name="password_confirmation"]').value.trim();

                    const errors = [];

                    // Validaciones básicas
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

                    if (!/[!@#$%^&*(),.?":{}|<>]/.test(newPassword)) {
                        errors.push("La nueva contraseña debe contener al menos un símbolo.");
                    }

                    if (newPassword !== confirmPassword) {
                        errors.push("Las nuevas contraseñas no coinciden.");
                    }

                    if (errors.length > 0) {
                        e.preventDefault(); // Evita que se envíe el formulario

                        // Crea y muestra el mensaje de error
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
    </script>


@endsection