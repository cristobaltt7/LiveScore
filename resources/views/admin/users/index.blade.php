@extends('layouts.app')

@section('content')

<link rel="stylesheet" href="{{ asset('css/styles.css') }}">

<!-- Contenedor principal -->
<div class="container py-4">
    <h3 class="text-white mb-4"><i class="bi bi-people-fill"></i> Usuarios registrados</h3>

    @if(session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif

<!-- Buscador dinámico -->
<div class="mb-4">
    <input type="text" id="searchInput" class="form-control" placeholder="Buscar por nombre...">
</div>

<!-- Tabla de usuarios-->
<div class="table-responsive">
    <table class="table table-hover table-bordered" id="usersTable">
        <thead class="table-light">
            <tr>
                <th>Nombre</th>
                <th>Email</th>
                <th>Rol</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $u)
            <tr>
                <td class="nombre">{{ $u->name }}</td>
                <td>{{ $u->email }}</td>
                <td>
                    <form action="{{ route('admin.users.update', $u) }}" method="POST" class="d-flex align-items-center">
                        @csrf
                        @method('PUT')
                        <select name="role" class="form-select form-select-sm me-2">
                            <option value="user" {{ $u->role === 'user' ? 'selected' : '' }}>User</option>
                            <option value="admin" {{ $u->role === 'admin' ? 'selected' : '' }}>Admin</option>
                        </select>
                        <button type="submit" class="btn btn-success btn-sm px-3">Actualizar rol</button>
                    </form>
                </td>

                <!-- Acciones: Ver perfil y eliminar usuario -->
                <td>
                    <a href="{{ route('admin.users.show', $u) }}" class="btn btn-sm btn-primary mb-1">Ver</a>
                    <form onsubmit="return confirmarEliminacion(this)" method="POST" action="{{ route('admin.users.destroy', $u) }}" class="form-eliminar d-inline">
                        @csrf
                        @method('DELETE')
                        <div class="confirmar-eliminar" style="display: none;">
                            <input type="text" name="confirm" placeholder="Escribe ELIMINAR" class="form-control form-control-sm mt-1">
                            <div class="text-danger mt-1 error-confirm"></div>
                        </div>
                        <button type="button" class="btn btn-sm btn-danger btn-mostrar-confirm">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
</div>

<script src="{{ asset('js/admin-users.js') }}"></script>

@endsection
