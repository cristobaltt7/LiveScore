@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/styles.css') }}">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

<div class="container py-5 text-white">
    <h2 class="mb-4 text-center"><i class="bi bi-person-circle"></i> Perfil de {{ $user->name }}</h2>

    @if (session('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill"></i> {{ session('status') }}
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Información general -->
    <div class="card bg-dark mb-4">
        <div class="card-body">
            <h5><i class="bi bi-info-circle"></i> Información general</h5>
            <p><strong>Nombre:</strong> {{ $user->name }}</p>
            <p><strong>Email:</strong> {{ $user->email }}</p>
            <p><strong>Rol:</strong> {{ $user->role }}</p>
            <p><strong>Miembro desde:</strong> {{ $user->created_at->format('d/m/Y') }}</p>
        </div>
    </div>

    <!-- Equipos favoritos -->
    @php $favorites = json_decode($user->favorite_teams ?? '{}', true); @endphp
    @if (!empty($favorites))
        <div class="card bg-dark mb-4">
            <div class="card-body">
                <h5><i class="bi bi-heart-fill text-danger"></i> Equipos favoritos</h5>
                <div class="row">
                    @foreach ($favorites as $teamId => $team)
                        <div class="col-md-3 text-center mb-3">
                            <div class="bg-secondary p-2 rounded">
                                <img src="{{ $team['logo'] }}" alt="Logo" class="img-fluid mb-2" style="max-height: 60px;">
                                <div>{{ $team['name'] }}</div>
                                <form action="{{ route('admin.users.removeFavorite', ['user' => $user->id, 'teamId' => $teamId]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger mt-1">Eliminar</button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif

    <!-- Editar perfil -->
    <div class="card bg-dark mb-4">
        <div class="card-body">
            <h5><i class="bi bi-pencil-square"></i> Editar perfil</h5>
            <form method="POST" action="{{ route('admin.users.update', $user->id) }}">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label>Nombre</label>
                    <input type="text" name="name" class="form-control bg-secondary text-white" value="{{ $user->name }}" required>
                </div>
                <div class="mb-3">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control bg-secondary text-white" value="{{ $user->email }}" required>
                </div>
                <button type="submit" class="btn btn-success w-100">Guardar cambios</button>
            </form>
        </div>
    </div>

    <!-- Cambiar contraseña -->
    <div class="card bg-dark mb-4">
        <div class="card-body">
            <h5><i class="bi bi-key"></i> Cambiar contraseña</h5>
            <form method="POST" action="{{ route('admin.users.changePassword', $user->id) }}">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label>Nueva contraseña</label>
                    <input type="password" name="password" class="form-control bg-secondary text-white" required>
                </div>
                <div class="mb-3">
                    <label>Confirmar nueva contraseña</label>
                    <input type="password" name="password_confirmation" class="form-control bg-secondary text-white" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Cambiar contraseña</button>
            </form>
        </div>
    </div>

    <a href="{{ route('admin.users') }}" class="btn btn-outline-light mt-3">
        <i class="bi bi-arrow-left"></i> Volver a la lista de usuarios
    </a>
</div>
@endsection
