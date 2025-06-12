@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/styles.css') }}">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

<!-- Contenedor principal del perfil -->
<div class="container py-5 text-body">

    <!-- Encabezado del perfil del usuario -->
    <h2 class="mb-4 text-center">
        <i class="bi bi-person-circle text-white"></i> 
        <span class="fw-bold text-white">Perfil de</span> 
        <span class="fw-bold text-white">{{ $user->name }}</span>
    </h2>

    <!-- Mensaje de estado tras alguna acción (por ejemplo, eliminar favorito) -->
    @if (session('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill"></i> {{ session('status') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Información general -->
    <div class="card bg-dark mb-4 text-body">
        <div class="card-body">
            <h5 class="text-white"><i class="bi bi-info-circle"></i> Información general</h5>
            <p><strong class="text-white">Nombre:</strong> <span class="text-white">{{ $user->name }}</span></p>
            <p><strong class="text-white">Email:</strong> <span class="text-white">{{ $user->email }}</span></p>
            <p><strong class="text-white">Rol:</strong> <span class="text-white">{{ $user->role }}</span></p>
            <p><strong class="text-white">Miembro desde:</strong> <span class="text-white">{{ $user->created_at->format('d/m/Y') }}</span></p>
        </div>
    </div>

    <!-- Equipos favoritos -->
    @php $favorites = json_decode($user->favorite_teams ?? '{}', true); @endphp
    @if (!empty($favorites))
        <div class="card bg-dark mb-4 text-body">
            <div class="card-body">
                <h5 class="text-white"><i class="bi bi-heart-fill text-danger"></i> Equipos favoritos</h5>
                <div class="row">
                    @foreach ($favorites as $teamId => $team)
                        <div class="col-md-3 text-center mb-3">
                            <div class="bg-secondary p-2 rounded">
                                <img src="{{ $team['logo'] }}" alt="Logo" class="img-fluid mb-2" style="max-height: 60px;">
                                <div class="text-white">{{ $team['name'] }}</div>
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

    <!-- Botón para volver a la lista de usuarios -->
    <a href="{{ route('admin.users') }}" class="btn btn-outline-light mt-3">
        <i class="bi bi-arrow-left"></i> Volver a la lista de usuarios
    </a>
</div>
@endsection
